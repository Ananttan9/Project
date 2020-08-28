<?php
	include("../../auth/EtreAuthentifie.php");
	$page_title="Formulaire ajout de commentaire pour une soutenance";
	include("../../header/header_index.php");
	
	$stage = intval($_POST['stage']);
	$nom = htmlspecialchars($_POST['nom']); 
	$prenom = htmlspecialchars($_POST['prenom']);
	if(isset($_SESSION['token'])) {
		$token = $_SESSION['token'];
	} else {
		redirect($pathFor['user']);
	}
?>
</br>
<div class="center">
    <form action="ajout_note_com.php" method="post">
		<p class="error"><?= $error??""?></p>
		</br></br>
		<h2>Ajout de note/commentaire</h2>
		</br>
		<div class="container" style="margin-top:10px; margin-left:20%;">
			<div class="row" style="margin-top:10px;">
				<div class="col-sm-4 label" style="font-size:110%;">Stage n° : </div>
                <div class="col-sm-2" style="font-size:110%;"><?php echo "$stage"; ?></div>
            </div>
			<?php echo "<input type='hidden' name='sid' value='$stage' />" ?>
			</br>
			<div class="row" style="margin-top:10px;">
				<div class="col-sm-4 label" style="font-size:110%;">Etudiant : </div>
                <div class="col-sm-2" style="font-size:110%;"><?php echo "$prenom $nom"; ?></div>
            </div>
			</br>
			<div class="row" style="margin-top:10px;">
				<div class="col-sm-4 label" style="font-size:110%;">Note : </div>
                <div class="col-sm-2"><input type="number" name="note" style="font-size:100%;" class="form-control" id="inputNote" placeholder="Note" required ></div>
            </div>
			</br>
			<div class="row" style="margin-top:10px;">
				<div class="col-sm-4 label" style="font-size:110%;">Commentaire : </div>
                <div class="col-sm-3"><textarea name="commentaire" style="height:100px; font-size:100%;" class="form-control" id="inputCom" placeholder="Commentaire" required ></textarea></div>
            </div>
		</br>
		<div class="form-group" style="margin-left:-20%; margin-top:10px; padding-bottom:230px;">
			<button type="submit" class="btn btn-primary" style="font-size:80%;">Valider</button>
        </div>
		<?php echo "<input type='hidden' name='CSRFToken' value='$token' />" ?>
    </form>
	</br>
</div>
</body>
</html>