</br></br>
<div class="center" style="margin-left:30%; background-color:white; color:#595959; padding: 20px 0px 20px 0px; width:600px;">
    <h2>Informations nouvelle soutenance</h2>
	</br>
	<p class="error"><?= $error??""?></p>
    <form method="post">
		<?php try {
				$SQL = "SELECT sid FROM stages
						WHERE sid NOT IN (SELECT sid FROM soutenances) ";
				$stmt = $db->prepare($SQL);
				$res = $stmt->execute();
				
				$SQL2 = "SELECT uid FROM users
						 WHERE actif=1 ";
				$stmt2 = $db->prepare($SQL2);
				$res = $stmt2->execute();
				
				$stmt3 = $db->prepare($SQL2);
				$res = $stmt3->execute();
				
				
				if($stmt->rowCount()==0) {
					?><div class="center">
							<strong>Aucun stage disponible pour une soutenance</strong>
					</div><?php
				} else {
			 ?>
        <div class="container" style="margin-top:5%;">
			<div class="row">
				<div class="col-sm-3 label" style="color:#595959;">Stage lié a la soutenance : </div>
				<div class="col-sm-3"><select name="sid" required>
						<option value="">-selectionner un stage-</option>
						<?php while($row=$stmt->fetch()) { 
							$sid = intval($row['sid']); ?>	
							<option value="<?php echo $sid; ?>"><?php echo $sid;?></option>
					<?php } ?>
				</select></div>
			</div>
			<div class="row" style="margin-top:2%;">
                <div class="col-sm-3 label" style="color:#595959;">Identifiant tuteur principal : </div>
                <div class="col-sm-3"><select name="tuteur1" required>
						<option value="">-selectionner un tuteur-</option>
						<?php while($row2=$stmt2->fetch()) { 
							$uid = intval($row2['uid']); ?>	
							<option value="<?php echo $uid; ?>"><?php echo $uid;?></option>
					<?php } ?>
				</select></div>
            </div>
			<div class="row" style="margin-top:2%;">
                <div class="col-sm-3 label" style="color:#595959;">Identifiant tuteur secondaire : </div>
				<div class="col-sm-3"><select name="tuteur2" required>
						<option value="">-selectionner un tuteur-</option>
						<?php while($row3=$stmt3->fetch()) { 
							$uid = intval($row3['uid']); ?>	
							<option value="<?php echo $uid; ?>"><?php echo $uid;?></option>
					<?php } ?>
				</select></div>
            </div>
			<div class="row" style="margin-top:2%;">
                <div class="col-sm-3 label" style="margin-top:0.5%; color:#595959;">Date : </div>
                <div class="col-sm-3"><input type="datetime-local" name="date" style="height:40px; font-size:100%;" class="form-control" required ></div>
            </div>
			<div class="row" style="margin-top:2%;">
                <div class="col-sm-3 label" style="margin-top:0.5%; color:#595959;">Salle : </div>
                <div class="col-sm-3"><input type="text" name="salle" style="height:40px; font-size:100%;" class="form-control" required ></div>
            </div>
			</br></br>
		</div>
		<?php echo "<input type='hidden' name='CSRFToken' value='$token' />" ?>
		</br>
		<div class="form-group">
			<button type="submit" class="btn btn-primary" style="font-size:90%;">Enregistrer</button>
        </div>
				<?php } ?>
			<?php $db=null;
			} catch (\PDOException $e) {
				http_response_code(500);
				echo "$e.";
				exit();
			} ?>
    </form>
</div>