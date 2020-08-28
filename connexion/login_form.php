<div class="image">
</br></br></br>
		<div class="container">
			<div class="row">
				<div class="col-sm-6" style="padding-right:5%; margin-left:-15px;">
					<div class="main-login main-center">
					<div class="panel-title text-center">
						<h2 style="margin-top:-10px;color:black;">Vous êtes étudiant ?</h2>
						<hr>
					</div>
					<a href="../etudiants/liste_soutenances.php" class="btn btn-default" style="background:white; color:black; font-size:80%; border:1px solid; border-radius:0px;">Liste des soutenances</a>
					</br></br></br>
					<form class="form-vertical" action="login.php" method="POST" >
						<div class="form-group">
							<label for="login" class="cols-sm-2 control-label" style="font-size:110%;">Déjà inscrit :</label>
							<div style="margin-left:100px;"><p style="font-size:90%;">(utilisez le numéro de référence qui vous a été fourni lors de votre première visite)</p>
							<div class="cols-sm-9">
								<div class="input-group">
									<input type="text" class="form-control" style="border-style:none none solid none; font-size:100%;" name="dossier" size="30"  placeholder="numéro" required />
								</div>
								<div class="center" style="margin-top:10px; font-size:80%;"><?php echo "<p class=\"error\">".($error2??"")."</p>"; ?></div>
								<button type="submit" class="btn btn-primary" style="margin-left:15%; font-size:90%; border-radius:5%;">Valider</button>
							</div>
							</div>
						</div>
						</br>
					</form>
					</br>
					<p style="font-size:110%; font-weight:bold;">Première visite :</p>
					<div style="margin-left:100px; font-size:90%;">
					<a href="../etudiants/ajout_etudiant.php" style="font-size:90%; color:white; border-radius:5%;" class="btn btn-primary">Inscription (formulaire)</a>
					<p>(renseignements concernant votre stage et votre identité)</p>
					</div>
				</div>
				</div>
				<div class="col-sm-6">
					<div class="main-login main-center2">
						<div class="panel-title text-center">
							<h2 style="margin-top:-10px;color:black;">Authentification</h2>
							<hr>
						</div>
						</br>
						<form class="form-horizontal" action="login.php" method="POST" >
							<div class="form-group">
								<label for="login" class="cols-sm-2 control-label">Login </label>
								<div class="cols-sm-10">
									<div class="input-group">
										<input type="text" class="form-control" style="border-style:none none solid none; font-size:100%;" name="login" size="30" id="login"  placeholder="Login" required />
									</div>
								</div>
							</div>
							</br>
							<div class="form-group">
								<label for="mot_de_passe" class="cols-sm-2 control-label">Mot de passe </label>
								<div class="cols-sm-10">
									<div class="input-group">
										<input type="password" class="form-control" style="border-style:none none solid none; font-size:100%;" name="password" size="10" id="password"  placeholder="Mot de passe" required />
										<span class="input-group-btn"><button class="btn btn-defaultCUST" id="view_button" style=" height: 34px;padding-left: 7px;" type="button"><span class="glyphicon glyphicon-eye-close" ></span>
									</div>
								</div>
							</div>
							<div class="center" style="margin-top:40px;"><?php echo "<p class=\"error\">".($error??"")."</p>"; ?></div>
							</br>
							<div class="form-group center">
								<button type="submit" class="btn btn-primary" style="margin-top:10px; font-size:90%; border-radius:5%;">Connexion</button>
							</div>
						</form>
						</br></br></br></br>
					</div>
				</div>
			</div>
		</div>
		</br></br>
	</div>
	</body>
</html>
