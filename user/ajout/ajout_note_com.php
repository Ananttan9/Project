<?php
	include("../../auth/EtreAuthentifie.php");
	$page_title="Formulaire ajout de note et commentaire pour une soutenance";
	include("../../header/header_user.php");
?>
<?php

$error = "";

if(!isset($_POST['CSRFToken']) || !isset($_POST['note']) || !isset($_POST['commentaire'])) {
	include("../../token.php");
	require("../../db_config.php");
		$uid = intval($_SESSION['uid']);
		try {
			$db = new PDO($dsn, $username, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$SQL = "SELECT stages.sid sid, nom, prenom FROM stages
					JOIN soutenances ON soutenances.sid = stages.sid
					JOIN etudiants ON stages.eid = etudiants.eid
					WHERE stages.sid NOT IN (SELECT sid FROM notes) AND (tuteur1 = $uid OR tuteur2 = $uid)
					 ";
			$st = $db->prepare($SQL);
			$res=$st->execute();
			if($st->rowCount()==0) {
				?><div class="center" style="font-size:120%;color:yellow;margin-top:200px;margin-left:30%;background:rgb(90,90,90);padding:10px 10px 10px 10px;width:40%;">
					<?php echo "Il n'y a aucune soutenance que vous pouvez noter ou commenter";?>
				</div><?php
			} else {
				?>
				<div class="table-custom" style="width:60%;margin-left:20%; margin-bottom:350px;">
					<h2>Liste des soutenances pour notation</h2>
					<p style="color:yellow;"><?php if(isset($_SESSION['mess'])) { echo htmlspecialchars($_SESSION['mess']); unset($_SESSION['mess']); } ?></p>
					</br></br>
					<table class="table center ">
					<thead><tr style="font-size:120%; color:#999999;"><th class="center">Stage n°</th><th class="center">Etudiant</th><th class="center">Note/commentaire</th></tr></thead>
					<?php	
					while($row=$st->fetch()) {
						$nom = htmlspecialchars($row['nom']);
						$prenom = htmlspecialchars($row['prenom']);
						$sid = htmlspecialchars($row['sid']);
							?>
							<tr class="center">
								<td><?php echo "$sid"; ?></td>
								<td><?php echo "$nom $prenom"; ?></td>
								<td><form action="ajout_note_com_form.php" method="post">
										<?php echo "<input type='hidden' name='stage' value='$sid' />" ?>
										<?php echo "<input type='hidden' name='nom' value='$nom' />" ?>
										<?php echo "<input type='hidden' name='prenom' value='$prenom' />" ?>
										<button type="submit" class="btn btn-default" style="font-size:80%;">ajouter note/commentaire<span style="font-size:120%; text-align:right; margin-left:10px; color:grey;" class="glyphicon glyphicon-plus"></span></button>
									</form>
								</td>
							</tr>
							<?php
					}
					?></table>
				</div>
			<?php
			}	
			$db=null;
		}
		catch(PDOException $e) {
			exit("Erreur de connexion ".$e->getMessage());
		}
		?>
		</br></br></br>
		<?php
		exit();
} else {
	$token = $_SESSION['token'];
	unset ($_SESSION['token']);
	$token_recu = htmlspecialchars($_POST['CSRFToken']);
	$result = hash_equals($token, $token_recu);
	if(!$result) {
		exit();
	}
}


foreach (['commentaire'] as $name) {
    $clearData[$name] = htmlspecialchars($_POST[$name]);
}

foreach (['sid', 'note'] as $name) {
    $clearData[$name] = intval($_POST[$name]);
}

require("../../db_config.php");
	try {
		$db = new PDO($dsn, $username, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$SQL = "INSERT INTO notes (sid, note, commentaire) VALUES (:sid, :note, :commentaire)";
		$st = $db->prepare($SQL);
		$res = $st->execute($clearData);
			
			if($st->rowCount()==0) {
				?><div class="center" style="font-size:120%;color:red;margin-top:200px;margin-left:33%;background:#e6e6e6;padding:10px 10px 10px 10px;width:400px;">
					
				</div><?php
			} else {
				?><div class="center" style="font-size:120%;color:red;margin-top:200px;margin-left:33%;background:#e6e6e6;padding:10px 10px 10px 10px;width:400px;">
					<p>Il y a eu un problème dans le numéro d'utilisateur.</p>
				</div><?php
			}
		
		$db=null;
	} catch (\PDOException $e) {
		http_response_code(500);
		echo "Erreur de serveur: '$e'";
		exit();
	}
?>

<?php include("../../footer.php"); ?>
