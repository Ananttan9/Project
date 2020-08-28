<?php
	require("../../auth/EtreAuthentifie.php");
	$page_title="Modification de la soutenance";
	include("../../header/header_admin.php");
?>
<?php
if(!isset($_POST['CSRFToken'])) {
	$stid = intval($_POST['stid']);
	$sid = intval($_POST['sid']);
	$tuteur1 = intval($_POST['tuteur1']);
	$tuteur2 = intval($_POST['tuteur2']);
	$nom1 = htmlspecialchars($_POST['nom1']);
	$prenom1 = htmlspecialchars($_POST['prenom1']);
	$nom2 = htmlspecialchars($_POST['nom2']);
	$prenom2 = htmlspecialchars($_POST['prenom2']);
	$date = htmlspecialchars($_POST['date']);
	$salle = htmlspecialchars($_POST['salle']);
	$token = htmlspecialchars($_POST['token']);

	require("../../db_config.php");
	$db = new PDO($dsn, $username, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	?>
	<div style="padding-bottom:100px; margin-top:150px;">
		<h2 class="center" style="font-size:150%; margin-top:-50px;">Modification de la soutenance n° <?php echo $stid; ?></h2>
		<form action="modif_soutenances_res.php" method="post">
			<div class="row" style="margin-top:30px;">
				<div class="col-sm-5 label" style="margin-top:0.5%;color:#595959;">Stage n° : </div>
				<div class="col-sm-2"><select class="form-control" name="sid" required>
					<option value="<?php echo $sid; ?>"><?php echo "$sid"; ?></option>
					<?php 
					$SQL = "SELECT sid FROM stages WHERE sid NOT IN (SELECT sid FROM soutenances) ";
					$st=$db->prepare($SQL);
					$res=$st->execute();											
					while($row=$st->fetch()) {
						$sid = intval($row['sid']);
						?><option value="<?php echo $sid; ?>"><?php echo "$sid";?></option>
					<?php } ?>
				</select></div>
			</div>
			<div class="row" style="margin-top:30px;">
				<div class="col-sm-5 label" style="margin-top:0.5%;color:#595959;">Id tuteur principal : </div>
				<div class="col-sm-2"><select class="form-control" name="tuteur1" required>
					<option value="<?php echo $tuteur1; ?>"><?php echo "-$nom1 $prenom1-"; ?></option>
					<?php 
					$SQL = "SELECT * FROM users WHERE actif = 1 ";
					$st=$db->prepare($SQL);
					$res=$st->execute();											
					while($row=$st->fetch()) {
						$nomP = htmlspecialchars($row['nom']);
						$prenomP = htmlspecialchars($row['prenom']);
						$uid = intval($row['uid']);
						?><option value="<?php echo $uid; ?>"><?php echo "$uid. $nomP $prenomP";?></option>
					<?php } ?>
				</select></div>
			</div>
			<div class="row" style="margin-top:30px;">
				<div class="col-sm-5 label" style="margin-top:0.5%;color:#595959;">Id tuteur secondaire : </div>
				<div class="col-sm-2"><select class="form-control" name="tuteur2" required>
					<option value="<?php echo $tuteur2; ?>"><?php echo "-$nom2 $prenom2-"; ?></option>
					<?php 
					$SQL = "SELECT * FROM users WHERE actif = 1 ";
					$st=$db->prepare($SQL);
					$res=$st->execute();											
					while($row=$st->fetch()) {
						$nomP = htmlspecialchars($row['nom']);
						$prenomP = htmlspecialchars($row['prenom']);
						$uid = intval($row['uid']);
						?><option value="<?php echo $uid; ?>"><?php echo "$uid. $nomP $prenomP";?></option>
					<?php } ?>
				</select></div>
			</div>
			<div class="row" style="margin-top:30px;">
				<div class="col-sm-5 label" style="margin-top:0.5%;color:#595959;">Date : </div>
				<div class="col-sm-3" style="left; width:250px;"><input type="datetime" style="height:40px; font-size:100%;" class="form-control" name="date" value="<?php echo "$date"; ?>" required ></div>
			</div>
			<div class="row" style="margin-top:30px;">
				<div class="col-sm-5 label" style="margin-top:0.5%;color:#595959;">Salle : </div>
				<div class="col-sm-3" style="left; width:250px;"><input type="text" style="height:40px; font-size:100%;" class="form-control" name="salle" value="<?php echo "$salle"; ?>" required ></div>
			</div>
			</br></br>
			<?php echo "<input type='hidden' name='stid' value='$stid' />"; ?>
			<?php echo "<input type='hidden' name='CSRFToken' value='$token' />"; ?>
			<div class="center">
				<button type="submit" class="btn btn-primary" style="font-size:100%;">Valider</button>
			</div>
		</form>
		</br>
	</div>
<?php } ?>