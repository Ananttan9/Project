<?php
	include("../../auth/EtreAuthentifie.php");
	$page_title="Formulaire modification de note";
	include("../../header/header_user.php");
?>
<?php

$error = "";
	include("../../token.php");
	require("../../db_config.php");
		$uid = intval($_SESSION['uid']);
		try {
			$db = new PDO($dsn, $username, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$SQL = "SELECT stages.sid sid, nom, prenom, note, commentaire FROM stages
					JOIN soutenances ON soutenances.sid = stages.sid
					JOIN etudiants ON stages.eid = etudiants.eid
					JOIN notes ON notes.sid = stages.sid
					WHERE (tuteur1 = ? OR tuteur2 = ?) ";
			$st = $db->prepare($SQL);
			$res=$st->execute(array($uid, $uid));
			if($st->rowCount()==0) {
				?><div class="center" style="font-size:120%; padding-bottom:500px; margin-top:10%;"><?php echo "Il n'y a aucune soutenance que vous pouvez noter ou commenter";?></div><?php
			} else {
				?>
				<div class="table-custom" style="width:90%;margin-left:5%; margin-bottom:350px;">
					<h2>Liste des soutenances pour modification</h2>
					<p style="color:yellow;"><?php if(isset($_SESSION['mess'])) { echo htmlspecialchars($_SESSION['mess']); unset($_SESSION['mess']); } ?></p>
					</br></br>
					<table class="table center ">
					<thead><tr style="font-size:120%; color:#999999;"><th class="center">Stage n°</th><th class="center">Etudiant</th><th class="center">Note</th><th class="center">Commentaire</th><th class="center"></th></tr></thead>
					<?php	
					while($row=$st->fetch()) {
						$nom = htmlspecialchars($row['nom']);
						$prenom = htmlspecialchars($row['prenom']);
						$sid = intval($row['sid']);
						$note = intval($row['note']);
						$commentaire = htmlspecialchars($row['commentaire']);
							?>
							<tr class="center">
								<td><?php echo "$sid"; ?></td>
								<td><?php echo "$nom $prenom"; ?></td>
								<td><?php echo "$note"; ?></td>
								<td style="width:300px;"><?php echo "$commentaire"; ?></td>
								<td><form action="modif_note_form.php" method="post">
										<?php echo "<input type='hidden' name='stage' value='$sid' />" ?>
										<?php echo "<input type='hidden' name='note' value='$note' />" ?>
										<button type="submit" class="btn btn-default" style="font-size:80%;">modifier note<span style="font-size:120%; text-align:right; margin-left:10px; color:grey;" class="glyphicon glyphicon-edit"></span></button>
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
		</br></br>
<?php include("../../footer.php"); ?>
