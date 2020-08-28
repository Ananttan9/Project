<?php
	require("../auth/EtreAuthentifie.php");
	$page_title="Page d'acceuil administrateur";
	include("../header/header_admin.php");
	$_SESSION['annee'] = date('Y');
?>

<div style="padding-bottom:100px;">
<div class="row">	
<div class="col-sm-6">
	<div class="cadre_sup1">
		<div class="cadre">
			<h2 style="font-size:130%;">Liste</h2>
				<hr class="hr_user">
					<div class="row" style="margin-top:20px;">
						<a href="liste/liste_users.php"><button class="btn btn-default" style="width:400px;font-size:100%; background: rgba(63, 66, 83, 0); border:1px solid; color:white;">Liste des utilisateurs</button></a>
					</div>
					<div class="row" style="margin-top:20px;">
						<a href="liste/liste_stages.php"><button class="btn btn-default" style="width:400px;font-size:100%; background: rgba(63, 66, 83, 0); border:1px solid;color:white;">Liste des stages</button></a>
					</div>
					<div class="row" style="margin-top:20px;">
						<a href="liste/liste_affectations.php"><button class="btn btn-default" style="width:400px;font-size:100%; background: rgba(63, 66, 83, 0); border:1px solid;color:white;">Liste des affectations des tuteurs pédagogiques</button></a>
					</div>
					<div class="row" style="margin-top:20px;">
						<a href="liste/liste_soutenances.php"><button class="btn btn-default" style="width:400px;font-size:100%; background: rgba(63, 66, 83, 0); border:1px solid;color:white;">Liste des soutenances</button></a>
					</div>
		</div>
		<div class="cadre" style="margin-top:60px;">
			<h2 style="font-size:130%;">Ajout</h2>
				<hr class="hr_user">
					<div class="row" style="margin-top:20px;">
						<a href="ajout/adduser.php"><button class="btn btn-default" style="width:400px;font-size:100%; background: rgba(63, 66, 83, 0); border:1px solid;color:white;">Ajouter un utilisateur</button></a>
					</div>
					<div class="row" style="margin-top:20px;">
						<a href="ajout/ajout_affectation.php"><button class="btn btn-default" style="width:400px;font-size:100%; background: rgba(63, 66, 83, 0); border:1px solid;color:white;">Affecter un tuteur pédagogique pour un stage</button></a>
					</div>
					<div class="row" style="margin-top:20px;">
						<a href="ajout/ajout_soutenance.php"><button class="btn btn-default" style="width:400px;font-size:100%; background: rgba(63, 66, 83, 0); border:1px solid;color:white;">Ajouter une soutenance</button></a>
					</div>
					<div class="row" style="margin-top:20px;">
						<a href="ajout/ajout_gestionnaire.php"><button class="btn btn-default" style="width:400px;font-size:100%; background: rgba(63, 66, 83, 0); border:1px solid;color:white;">Ajouter un gestionnaire administratif</button></a>
					</div>
		</div>
	</div>
</div>
<div class="col-sm-6">
	<div class="cadre_sup2">
		<div class="cadre">
			<h2 style="font-size:130%;">Suppression</h2>
				<hr class="hr_user">
					<div class="row" style="margin-top:20px;">
						<a href="suppression/suppr_stage_form.php"><button class="btn btn-default" style="width:400px;font-size:100%; background: rgba(63, 66, 83, 0); border:1px solid;color:white;">Supprimer un stage</button></a>
					</div>
					<div class="row" style="margin-top:20px;">
						<a href="suppression/suppr_affectation_form.php"><button class="btn btn-default" style="width:400px;font-size:100%; background: rgba(63, 66, 83, 0); border:1px solid;color:white;">Supprimer une affectation</button></a>
					</div>
					<div class="row" style="margin-top:20px;">
						<a href="suppression/suppr_soutenance.php"><button class="btn btn-default" style="width:400px;font-size:100%; background: rgba(63, 66, 83, 0); border:1px solid;color:white;">Supprimer une soutenance</button></a>
					</div>
					<div class="row" style="margin-top:20px;">
						<a href="suppression/suppr_gestionnaire.php"><button class="btn btn-default" style="width:400px;font-size:100%; background: rgba(63, 66, 83, 0); border:1px solid;color:white;">Supprimer un gestionnaire administratif</button></a>
					</div>
		</div>
		<div class="cadre" style="margin-top:60px;">
			<h2 style="font-size:130%;">Modification</h2>
				<hr class="hr_user" style="height:0.5px;">
					<div class="row" style="margin-top:20px;">
						<a href="modification/modif_soutenances.php"><button class="btn btn-default" style="width:400px;font-size:100%; background: rgba(63, 66, 83, 0); border:1px solid;color:white;">Modifier une soutenance</button></a>
					</div>
					<div class="row" style="margin-top:20px;">
						<a href="modification/modif_affectations.php"><button class="btn btn-default" style="width:400px;font-size:100%; background: rgba(63, 66, 83, 0); border:1px solid;color:white;">Modifier une affectation</button></a>
					</div>
					<div class="row" style="margin-top:20px;">
						<a href="modification/modif_token.php"><button class="btn btn-default" style="width:400px;font-size:100%; background: rgba(63, 66, 83, 0); border:1px solid;color:white;">Modifier un token de gestionnaire</button></a>
					</div>
					<div class="row" style="margin-top:20px;">
						<a href="modification/modif_mdp.php"><button class="btn btn-default" style="width:400px;font-size:100%; background: rgba(63, 66, 83, 0); border:1px solid;color:white;">Modifier un mot de passe utilisateur</button></a>
					</div>
		</div>
	</div>
</div>
</div>
</div>
