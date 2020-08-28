<?php
	require("../../auth/EtreAuthentifie.php");
	$page_title="Modification du tuteur pédagogique";
	include("../../header/header_admin.php");
?>
<?php
	$uid = intval($_POST['uid']);
	$sid = intval($_POST['sid']);
	$nom = htmlspecialchars($_POST['nom']);
	$prenom = htmlspecialchars($_POST['prenom']);
	$token = htmlspecialchars($_POST['token']);
?>
<div class="center" style="margin-left:30%;margin-top:100px; background-color:white; color:#595959; padding: 10px 10px 10px 10px; width:600px;">
	<h2 class="center" style="font-size:150%;">Changement de tuteur</h2>
	</br>
	<form action="modif_affectations_res.php" method="post">
		<div class="row" style="margin-top:30px;">
			<div class="col-sm-5 label" style="margin-top:0.5%;color:#595959;">Stage n° : </div>
			<div class="col-sm-3" style="left; width:250px;"><input type="text" style="height:40px; font-size:100%;" class="form-control" value="<?php echo "$sid"; ?>" readonly ></div>
		</div>
		<div class="row" style="margin-top:30px;">
			<div class="col-sm-5 label" style="margin-top:0.5%;color:#595959;">Tuteur actuel : </div>
			<div class="col-sm-3" style="left; width:250px;"><input type="text" style="height:40px; font-size:100%;" class="form-control" value="<?php echo "$nom $prenom"; ?>" readonly ></div>
		</div>
		<div class="row" style="margin-top:30px;">
			<div class="col-sm-5 label" style="margin-top:0.5%;color:#595959;">Nouveau tuteur : </div>
			<div class="col-sm-5"><select class="form-control" name="uid" required>
				<option value="">-selectionner un tuteur-</option>
				<?php 
				require("../../db_config.php");
				$db = new PDO($dsn, $username, $password);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$SQL = "SELECT * FROM users
						 WHERE actif = 1
						";
				$st=$db->prepare($SQL);
				$res=$st->execute();
															
				while($row=$st->fetch()) {
					$nomP = htmlspecialchars($row['nom']);
					$prenomP = htmlspecialchars($row['prenom']);
					$uid = intval($row['uid']);
					?><option value="<?php echo $uid; ?>"><?php echo "$nomP $prenomP";?></option>
				<?php } ?>
			</select></div>
		</div>
		</br></br>
		<?php echo "<input type='hidden' name='sid' value='$sid' />"; ?>
		<?php echo "<input type='hidden' name='CSRFToken' value='$token' />"; ?>
		<div class="center">
			<button type="submit" class="btn btn-primary" style="font-size:100%;">Valider</button>
		</div>
	</form>
	</br>
</div>