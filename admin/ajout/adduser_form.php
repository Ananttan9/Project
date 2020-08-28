
</br>
<div class="center" style="margin-left:30%; background-color:white; color:black; padding: 20px 0px 20px 0px; width:600px;">
    <h1>Nouvel utilisateur</h1>
	<hr style="width:40%; margin-right:auto; height:2px;">
	<p class="error"><?= $error??""?></p>
    <form action="adduser.php" method="post">
        <div class="container" style="margin-top:5%;">
			<div class="row">
				<div class="col-sm-2 label" style="margin-top:0.5%; color:#595959;">Nom : </div>
                <div class="col-sm-3"><input type="text" name="nom" style="height:40px; font-size:100%;" class="form-control"></div>
            </div>
			<div class="row" style="margin-top:2%;">
                <div class="col-sm-2 label" style="margin-top:0.5%; color:#595959;">Prénom : </div>
                <div class="col-sm-3"><input type="text" name="prenom" style="height:40px; font-size:100%;" class="form-control" ></div>
            </div>
			<div class="row" style="margin-top:2%;">
                <div class="col-sm-2 label" style="margin-top:0.5%; color:#595959;">Nouveau login : </div>
                <div class="col-sm-3"><input type="text" name="login" style="height:40px; font-size:100%;" class="form-control" required ></div>
            </div>
			<div class="row" style="margin-top:2%;">
                <div class="col-sm-2 label" style="margin-top:0.5%; color:#595959;">Nouveau mdp : </div>
                <div class="col-sm-3"><input type="password" name="mdp" style="height:40px; font-size:100%;" class="form-control" required ></div>
            </div>
			<div class="row" style="margin-top:2%;">
                <div class="col-sm-2 label" style="margin-top:0.5%; color:#595959;">Répéter mdp : </div>
                <div class="col-sm-3"><input type="password" name="mdp2" style="height:40px; font-size:100%;" class="form-control"required ></div>
            </div>
			<div class="row" style="margin-top:2%;">
                <div class="col-sm-2 label" style="margin-top:0.5%; color:#595959;">Role : </div>
                <div class="col-sm-3">
					<select class="form-control" name="role" required>
						<option value=""></option>
						<option value="admin">admin</option>
						<option value="user">user</option>
					</select>
				</div>
            </div>
			<div class="row" style="margin-top:2%;">
                <div class="col-sm-2 label" style="margin-top:0.5%; color:#595959;">Activation : </div>
                <div class="col-sm-3">
					<select class="form-control" name="actif" required>
						<option value=""></option>
						<option value=1>actif</option>
						<option value=0>non actif</option>
					</select>
				</div>
            </div>
			</br>
		</div>
		<?php echo "<input type='hidden' name='CSRFToken' value='$token' />" ?>
		</br>
		<div class="form-group">
			<button type="submit" class="btn btn-primary" style="font-size:90%;">Enregistrer</button>
        </div>
    </form>
</div>
</br></br></br>
</body>
</html>