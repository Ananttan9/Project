<?php
	include("../../auth/EtreAuthentifie.php");
	$page_title="Formulaire changement de note";
	include("../../header/header_user.php");
	
	$stage = intval($_POST['stage']);
	$note = intval($_POST['note']); 
	if(isset($_SESSION['token'])) {
		$token = $_SESSION['token'];
	} else {
		redirect($pathFor['user']);
	}
?>
</br>
<div class="center" style="margin-left:30%; background:white; color:#595959; padding: 10px 10px 10px 10px; width:500px;">
    <form action="modif_note_res.php" method="post">
		<p class="error"><?= $error??""?></p>
		</br>
		<h2>Modification de note</h2>
		</br>
		<div style="margin-left:10%;">
			</br>
			<div class="row" style="margin-top:10px;">
				<div class="col-sm-6" style="font-size:110%; text-align:right;">Stage n° : </div>
                <div class="col-sm-2" style="font-size:110%;"><?php echo "$stage"; ?></div>
            </div>
			<?php echo "<input type='hidden' name='sid' value='$stage' />" ?>
			</br>
			<div class="row" style="margin-top:10px;">
				<div class="col-sm-6" style="font-size:110%;text-align:right;">Note actuelle: </div>
                <div class="col-sm-2" style="font-size:110%;"><?php echo "$note"; ?></div>
            </div>
			</br>
			<div class="row" style="margin-top:10px;">
				<div class="col-sm-6" style="font-size:110%;text-align:right;">Nouvelle note : </div>
                <div class="col-sm-4"><input type="number" name="note" style="font-size:100%;" class="form-control" id="inputNote" placeholder="Note" required ></div>
            </div>
		</br>
		<div class="form-group" style="margin-left:-20%; margin-top:10px; padding-bottom:30px;">
			<button type="submit" class="btn btn-primary" style="font-size:80%;">Valider</button>
        </div>
		<?php echo "<input type='hidden' name='CSRFToken' value='$token' />" ?>
		</div>
	</form>
</div>
</br></br></br>