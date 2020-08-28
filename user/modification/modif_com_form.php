<?php
	include("../../auth/EtreAuthentifie.php");
	$page_title="Formulaire changement de commentaire";
	include("../../header/header_user.php");
	
	$stage = intval($_POST['stage']);
	$commentaire = htmlspecialchars($_POST['commentaire']);
	if(isset($_SESSION['token'])) {
		$token = $_SESSION['token'];
	} else {
		redirect($pathFor['user']);
	}
?>
</br>
<div class="center" style="margin-left:22%; background:white; color:#595959; padding: 10px 10px 10px 10px; width:800px;">
    <form action="modif_com_res.php" method="post">
		<p class="error"><?= $error??""?></p>
		<h2>Modification de commentaire</h2>
		</br>
		<div class="container" style="margin-top:10px;">
			<div class="row" style="margin-top:10px;">
				<div class="col-sm-3" style="font-size:110%;text-align:right;">Stage n° : </div>
                <div class="col-sm-2" style="font-size:110%;"><?php echo "$stage"; ?></div>
            </div>
			<?php echo "<input type='hidden' name='sid' value='$stage' />" ?>
			</br>
			<div class="row" style="margin-top:10px;">
				<div class="col-sm-3" style="font-size:110%;text-align:right;">Commentaire actuelle: </div>
                <div class="col-sm-4"><textarea style="font-size:100%; height:100px;" class="form-control" placeholder="<?php echo "$commentaire"; ?>" readonly></textarea></div>
            </div>
			</br>
			<div class="row" style="margin-top:10px;">
				<div class="col-sm-3" style="font-size:110%;text-align:right;">Nouveau commentaire : </div>
                <div class="col-sm-4"><textarea name="commentaire" style="font-size:100%; height:100px;" class="form-control" id="inputCom" placeholder="Commentaire" required ></textarea></div>
            </div>
		</br>
		</div>
		<div class="form-group" style="margin-left:0%; margin-top:10px; padding-bottom:20px;">
			<button type="submit" class="btn btn-primary" style="font-size:80%;">Valider</button>
        </div>
		<?php echo "<input type='hidden' name='CSRFToken' value='$token' />" ?>
	</form>
</div>
</br></br></br></br>
</body>
</html>