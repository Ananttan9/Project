<?php
	require("../auth/EtreAuthentifie.php");
	$page_title="Page d'acceuil utilisateur";
	include("../header/header_user.php");
?>
<?php
	require("../db_config.php");
	$uid = htmlspecialchars($_SESSION['uid']);
	try {
		$db = new PDO($dsn, $username, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$SQL = "SELECT actif FROM users
				WHERE uid=? ";
		$st = $db->prepare($SQL);
		$res=$st->execute(array($uid));
		if($st->rowCount()==0) {
			?><div class="center" style="font-size:120%; padding-bottom:200px;"><?php echo "Erreur, pas de champ actif";?></div><?php
		} else {
			while($row=$st->fetch()) {
				if($row['actif'] == 0) {
					$_SESSION['actif'] = 0;
				} else {
					$_SESSION['actif'] = 1;
				}
			}
		}
		$db=null;
	}
	catch(PDOException $e) {
		exit("Erreur de connexion ".$e->getMessage());
	}
?>

<div style="padding-bottom:100px;">
	<div class="row">	
		<div class="col-sm-6">
			<div class="cadre_sup1">
				<div class="cadre">
					<h2 style="font-size:130%;">Liste</h2>
						<hr class="hr_user">
							<div class="row" style="margin-top:20px;">
								<a href="liste/liste_etudiants.php"><button class="btn btn-default" style="width:400px;font-size:100%; background: rgba(63, 66, 83, 0); border:1px solid; color:white;">Etudiants dont on est le tuteur</button></a>
							</div>
							<div class="row" style="margin-top:20px;">
								<a href="liste/liste_soutenances_tuteur.php"><button class="btn btn-default" style="width:400px;font-size:100%; background: rgba(63, 66, 83, 0); border:1px solid;color:white;">Soutenances auquelles on participe</button></a>
							</div>
				</div>
				<div class="cadre" style="margin-top:60px;">
					<h2 style="font-size:130%;">Ajout</h2>
						<hr class="hr_user">
							<div class="row" style="margin-top:20px;">
								<a href="ajout/ajout_note_com.php"><button class="btn btn-default" style="width:400px;font-size:100%; background: rgba(63, 66, 83, 0); border:1px solid;color:white;">Ajouter une note ou un commentaire</button></a>
							</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="cadre_sup2">
				<div class="cadre" style="margin-top:60px;">
					<h2 style="font-size:130%;">Modification</h2>
					<hr class="hr_user" style="height:0.5px;">
					<div class="row" style="margin-top:20px;">
						<a href="modification/modif_note.php"><button class="btn btn-default" style="width:400px;font-size:100%; background: rgba(63, 66, 83, 0); border:1px solid;color:white;">Modifier une note</button></a>
					</div>
					<div class="row" style="margin-top:20px;">
						<a href="modification/modif_com.php"><button class="btn btn-default" style="width:400px;font-size:100%; background: rgba(63, 66, 83, 0); border:1px solid;color:white;">Modifier un commentaire</button></a>
					</div>
					<div class="row" style="margin-top:20px;">
						<a href="modification/modif_mdp.php"><button class="btn btn-default" style="width:400px;font-size:100%; background: rgba(63, 66, 83, 0); border:1px solid;color:white;">Modifier son mot de passe</button></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div style="margin-top:260px;"></div>
		
	<?php
	include("../footer.php");
	?>