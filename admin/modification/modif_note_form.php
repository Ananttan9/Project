<?php
	require("../../auth/EtreAuthentifie.php");
	$page_title="Modification de la note de la soutenance";
	include("../../header/header_admin.php");
?>
<?php
if(!isset($_POST['CSRFToken'])) {
	$stid = intval($_POST['stid']);
	$sid = intval($_POST['sid']);
	$note = intval($_POST['note']);
	$token = htmlspecialchars($_POST['token']);

	require("../../db_config.php");
	$db = new PDO($dsn, $username, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	?>
	<div class="center" style="margin-left:30%;margin-top:100px; background-color:white; color:#595959; padding:10px 10px 10px 10px; width:600px;">
		<h2 class="center" style="font-size:150%;">Modification de la soutenance n° <?php echo $stid; ?></h2>
		<form action="modif_note_res.php" method="post">
			<div class="row" style="margin-top:30px;">
				<div class="col-sm-5 label" style="margin-top:0.5%;color:#595959;">Stage n° : </div>
				<div class="col-sm-3" style="left; width:250px;"><input type="number" style="height:40px; font-size:100%;" class="form-control" name="sid" value="<?php echo "$sid"; ?>" readonly ></div>
			</div>
			<div class="row" style="margin-top:30px;">
				<div class="col-sm-5 label" style="margin-top:0.5%;color:#595959;">Ancienne note : </div>
				<div class="col-sm-3" style="left; width:250px;"><input type="number" style="height:40px; font-size:100%;" class="form-control" name="note" value="<?php echo "$note"; ?>" readonly ></div>
			</div>
			<div class="row" style="margin-top:30px;">
				<div class="col-sm-5 label" style="margin-top:0.5%;color:#595959;">Nouvelle note : </div>
				<div class="col-sm-3" style="left; width:250px;"><input type="number" style="height:40px; font-size:100%;" class="form-control" name="new_note" required ></div>
			</div>
			</br></br>
			<?php echo "<input type='hidden' name='stid' value='$stid' />"; 
			 echo "<input type='hidden' name='CSRFToken' value='$token' />"; ?>
			<div class="center">
				<button type="submit" class="btn btn-primary" style="font-size:100%;">Valider</button>
			</div>
		</form>
		</br>
	</div>
<?php } ?>