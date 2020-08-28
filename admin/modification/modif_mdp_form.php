<?php
	require("../../auth/EtreAuthentifie.php");
	$page_title="Modification du mot de passe";
	include("../../header/header_admin.php");
?>
<?php
	$uid = intval($_POST['uid']);
	$token = htmlspecialchars($_POST['token']);
?>
<div class="center" style="margin-left:25%;margin-top:100px; background-color:white; color:#595959; padding: 10px 10px 10px 10px; width:700px;">
	<h2 class="center" style="font-size:150%;">Changement de mot de passe</h2>
	</br>
	<form action="modif_mdp_res.php" method="post">
		<div class="row" style="margin-top:30px;">
			<div class="col-sm-5 label" style="margin-top:0.5%;color:#595959;">Nouveau mot de passe : </div>
			<div class="col-sm-3" style="left; width:250px;"><input type="password" name="new_mdp" style="height:40px; font-size:100%;" class="form-control" id="inputMpd" placeholder="nouveau mot de passe" required ></div>
		</div>
		<div class="row" style="margin-top:30px;">
			<div class="col-sm-5 label" style="margin-top:0.5%;color:#595959;">Répéter nouveau mot de passe : </div>
			<div class="col-sm-3" style="left; width:250px;"><input type="password" name="new2_mdp" style="height:40px; font-size:100%;" class="form-control" id="inputMpd2" placeholder="repeter mot de passe" required ></div>
		</div>
		</br></br>
		<?php echo "<input type='hidden' name='uid' value='$uid' />"; ?>
		<?php echo "<input type='hidden' name='CSRFToken' value='$token' />"; ?>
		<div class="center">
			<button type="submit" class="btn btn-primary" style="font-size:100%;">Valider</button>
		</div>
	</form>
	</br>
</div>