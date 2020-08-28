</br>
<div class="cadre_form center">
    <h1>Formulaire d'inscription</h1>
    <form method="post">
		<p class="error"><?= $error??""?></p>
		<h2 class="mini_titre">Informations personnelles</h2>
		<div class="container" style="margin-top:10px;">
			<div class="row" style="margin-top:12px;">
				<div class="col-sm-3 label" style="margin-top:0.5%;color:#595959;">Nom : </div>
                <div class="col-sm-4"><input type="text" name="nom" style="height:40px; font-size:110%;" class="form-control" placeholder="Nom" required ></div>
            </div>
			<div class="row" style="margin-top:3%;">
                <div class="col-sm-3 label" style="margin-top:0.5%;color:#595959;">Prénom : </div>
                <div class="col-sm-4"><input type="text" name="prenom" style="height:40px; font-size:110%;" class="form-control" placeholder="Prénom" required ></div>
            </div>
			<div class="row" style="margin-top:3%;">
                <div class="col-sm-3 label" style="margin-top:0.5%;color:#595959;">email : </div>
                <div class="col-sm-4"><input type="email" name="email" style="height:40px; font-size:110%;" class="form-control" placeholder="email" required ></div>
            </div>
			<div class="row" style="margin-top:3%;">
                <div class="col-sm-3 label" style="margin-top:0.5%;color:#595959;">téléphone : </div>
                <div class="col-sm-4"><input type="tel" name="tel" style="height:40px; font-size:110%;" class="form-control" placeholder="Téléphone" minlength="10" maxlength="10" required ></div>
            </div>
		</div>
		</br>
		<h2 class="mini_titre">Informations du stage</h2>
		<div class="container" style="margin-top:10px;">
			<div class="row" style="margin-top:12px;">
                <div class="col-sm-3 label" style="margin-top:0.5%;color:#595959;">Titre/intitulé du stage : </div>
                <div class="col-sm-4"><input type="text" name="titre" style="height:40px; font-size:110%;" class="form-control" id="inputTitre" placeholder="Titre" required ></div>
            </div>
			<div class="row" style="margin-top:3%;">
				<div class="col-sm-3 label" style="margin-top:0.5%;color:#595959;">Description du stage : </div>
                <div class="col-sm-4"><textarea type="textarea" name="description" style="font-size:110%;" class="form-control" id="inputDescription" placeholder="Description" required ></textarea></div>
            </div>
			<div class="row" style="margin-top:3%;">
				<div class="col-sm-3 label" style="margin-top:0.5%;color:#595959;">Nom de l'entreprise : </div>
                <div class="col-sm-4"><input type="text" name="nomE" style="height:40px; font-size:110%;" class="form-control" id="inputEntreprise" placeholder="Entreprise" required ></div>
            </div>
			<div class="row" style="margin-top:3%;">
				<div class="col-sm-3 label" style="margin-top:0.5%;color:#595959;">Tuteur dans l'entreprise : </div>
                <div class="col-sm-4"><input type="text" name="tuteurE" style="height:40px; font-size:110%;" class="form-control" id="inputTuteurE" placeholder="Nom et prénom" required value="<?= $data['tuteurE']??""?>"></div>
            </div>
			<div class="row" style="margin-top:3%;">
				<div class="col-sm-3 label" style="margin-top:0.5%;color:#595959;">Email du tuteur : </div>
                <div class="col-sm-4"><input type="email" name="emailE" style="height:40px; font-size:110%;" class="form-control" id="inputEmailE" placeholder="Email" required value="<?= $data['emailE']??""?>"></div>
            </div>
			<div class="row" style="margin-top:3%;">
				<div class="col-sm-3 label" style="margin-top:0.5%;color:#595959;">Dates de stage : </div>
                <div class="col-sm-1">Du</div>
				<div class="col-sm-3"><input type="date" name="dateD" style="height:40px; font-size:110%;" class="form-control" id="inputDebut" placeholder="Début" required value="<?= $data['dateD']??""?>"></div>
			</div>
			<div class="row" style="margin-top:1%;">
				<div class="col-sm-3"></div>
                <div class="col-sm-1">au</div>
				<div class="col-sm-3"><input type="date" name="dateF" style="height:40px; font-size:110%;" class="form-control" id="inputFin" placeholder="Fin" required value="<?= $data['dateF']??""?>"></div>
            </div>
			</br></br>
		</div>
		</br>
		<div class="form-group">
			<button type="submit" class="btn btn-primary" style="font-size:100%;">S'enregistrer</button>
        </div>
		<?php echo "<input type='hidden' name='CSRFToken' value='$token' />" ?>
    </form>
	</br></br>
</div>
</br></br></br>
</body>
</html>
