

</br></br>
<div class="center" style="margin-left:25%; background:white; color:#595959; padding: 10px 10px 10px 10px; width:700px;">
	<h2 class="center" style="font-size:150%;">Changement de mot de passe</h2>
	<form action="modif_mdp.php" method="post">
		<div class="row" style="margin-top:60px;">
			<div class="col-sm-5" style="margin-top:0.5%;text-align:right;">Ancien mot de passe : </div>
			<div class="col-sm-4" style="left; width:300px;"><input type="password" name="old_mdp" style="height:40px; font-size:100%; border-radius:20px;" class="form-control" id="inputMpd1" placeholder="ancien mot de passe" required ></div>
		</div>
		<div class="row" style="margin-top:30px;">
			<div class="col-sm-5" style="margin-top:0.5%;text-align:right;">Nouveau mot de passe : </div>
			<div class="col-sm-4" style="left; width:300px;"><input type="password" name="new_mdp" style="height:40px; font-size:100%; border-radius:20px;" class="form-control" id="inputMpd2" placeholder="nouveau mot de passe" required ></div>
		</div>
		<div class="row" style="margin-top:30px;">
			<div class="col-sm-5" style="margin-top:0.5%;text-align:right;">Répéter nouveau mot de passe : </div>
			<div class="col-sm-4" style="left; width:300px;"><input type="password" name="new2_mdp" style="height:40px; font-size:100%; border-radius:20px;" class="form-control" id="inputMpd3" placeholder="repeter mot de passe" required ></div>
		</div>
		</br></br>
		<?php echo "<input type='hidden' name='CSRFToken' value='$token' />"; ?>
		<div class="center"><?php echo "<p class=\"error\">".($error1??"")."</p>"; ?></div>
		<div class="center"><?php echo "<p class=\"error\">".($error2??"")."</p>"; ?></div>
		<div class="center">
			<button type="submit" class="btn btn-primary" style="font-size:100%;">Valider</button>
		</div>
	</form>
</br>
</div>