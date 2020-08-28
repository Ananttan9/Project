</br></br>
<div class="center" style="margin-left:30%; background-color:white; color:#595959; padding: 20px 0px 20px 0px; width:600px;">
    <h2>Informations nouveau gestionnaire</h2>
	<p class="error"><?= $error??""?></p>
    <form method="post">
        <div class="container" style="margin-top:5%;">
			<div class="row" style="margin-top:2%;">
                <div class="col-sm-2 label" style="margin-top:0.5%; color:#595959;">Nom : </div>
                <div class="col-sm-3"><input type="text" name="nom" style="height:40px; font-size:100%;" class="form-control" required ></div>
            </div>
			<div class="row" style="margin-top:2%;">
                <div class="col-sm-2 label" style="margin-top:0.5%; color:#595959;">Prénom : </div>
                <div class="col-sm-3"><input type="text" name="prenom" style="height:40px; font-size:100%;" class="form-control" required ></div>
            </div>
			<div class="row" style="margin-top:2%;">
                <div class="col-sm-2 label" style="margin-top:0.5%; color:#595959;">Email : </div>
                <div class="col-sm-3"><input type="email" name="email" style="height:40px; font-size:100%;" class="form-control" required ></div>
            </div>
			</br></br>
		</div>
		<?php $tokenG = bin2hex(random_bytes(27));
		 echo "<input type='hidden' name='token' value='$token' />";
		 echo "<input type='hidden' name='tokenG' value='$tokenG' />"; ?>
		</br>
		<div class="form-group">
			<button type="submit" class="btn btn-primary" style="font-size:90%;">Enregistrer</button>
        </div>
    </form>
	</br></br>
</div>
	</body>
</html>