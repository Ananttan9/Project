<?php
	require("../../auth/EtreAuthentifie.php");
	$page_title="Modification soutenances";
	include("../../header/header_admin.php");
	?>
		<?php
		$error = "";
		require("../../db_config.php");
			include("../../token.php");
			try {	
				$db = new PDO($dsn, $username, $password);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$SQL = "SELECT * FROM soutenances
						JOIN users ON soutenances.tuteur1 = users.uid
						WHERE sid NOT IN (SELECT sid FROM notes) ";
				$st=$db->prepare($SQL);
				$res=$st->execute();
				
				$SQL3 = "SELECT * FROM soutenances
						JOIN users ON soutenances.tuteur1 = users.uid
						JOIN notes ON soutenances.sid = notes.sid ";
				$st3=$db->prepare($SQL3);
				$res=$st3->execute();
				
				?>
					<div class="table-custom" style="width:90%;margin-left:5%;margin-bottom:100px;padding-bottom:50px;">
						<h2>Soutenances a venir</h2>
						<p style="color:yellow;"><?php if(isset($_SESSION['mess'])) { echo htmlspecialchars($_SESSION['mess']); unset($_SESSION['mess']); } ?></p>
						</br>
						<table class="table center ">
						<thead><tr style="font-size:120%; color:#999999;"><th class="center">Soutenance</th><th class="center">Stage</th><th class="center">Tuteur principal</th><th class="center">Tuteur secondaire</th><th class="center">Date</th><th class="center">Salle</th><th></th></tr></thead>
						<?php	
						if($st->rowCount()==0) {
							?><tr><td><div class="center" style="font-size:120%;"><?php echo "Aucune soutenance trouvée dans la base de donnée.";?></div></td></tr><?php
						} else {
							while($row=$st->fetch()) {
									$stid = intval($row['stid']);
									$sid = intval($row['sid']);
									$tuteur1 = htmlspecialchars($row['tuteur1']);
									$nom1 = htmlspecialchars($row['nom']);
									$prenom1 = htmlspecialchars($row['prenom']);
									$tuteur2 = htmlspecialchars($row['tuteur2']);
									$date = htmlspecialchars($row['date']);
									$salle = htmlspecialchars($row['salle']);
									
									$SQL2 = "SELECT nom, prenom FROM users
											 WHERE uid=?";
									$st2 = $db->prepare($SQL2);
									$res=$st2->execute(array($tuteur2));
									while($row2=$st2->fetch()) {
										$nom2 = htmlspecialchars($row2['nom']);
										$prenom2 = htmlspecialchars($row2['prenom']);
									?>
									<tr class="center">
										<td><?php echo $stid?></td><?php
										?><td><?php echo $sid;?></td>
										<td><?php echo "$nom1 $prenom1";?></td>
										<td><?php echo "$nom2 $prenom2";?></td>
										<td><?php echo $date;?></td>
										<td><?php echo $salle;?></td>
										<td><form action="modif_soutenances_form.php" method="post">
												<?php echo "<input type='hidden' name='sid' value='$sid' />"; 
												 echo "<input type='hidden' name='stid' value='$stid' />"; 
												 echo "<input type='hidden' name='tuteur1' value='$tuteur1' />";
												 echo "<input type='hidden' name='tuteur2' value='$tuteur2' />";
												 echo "<input type='hidden' name='nom1' value='$nom1' />";
												 echo "<input type='hidden' name='prenom1' value='$prenom1' />";
												 echo "<input type='hidden' name='nom2' value='$nom2' />";
												 echo "<input type='hidden' name='prenom2' value='$prenom2' />";
												 echo "<input type='hidden' name='date' value='$date' />";
												 echo "<input type='hidden' name='salle' value='$salle' />";
												 echo "<input type='hidden' name='token' value='$token' />"; ?>
												<button type="submit" class="btn btn-default" style="font-size:80%;">modifier</button>
											</form>
										</td>
									</tr><?php
									}
							}
						}
						?></table>
						</br></br></br></br></br>
						<h2>Soutenances passées</h2>
						<p style="color:yellow;"><?php if(isset($_SESSION['mess2'])) { echo htmlspecialchars($_SESSION['mess2']); unset($_SESSION['mess2']); } ?></p>
						</br>
						<table class="table center ">
						<thead><tr style="font-size:120%; color:#999999;"><th class="center">Soutenance</th><th class="center">Stage</th><th class="center">Tuteur principal</th><th class="center">Tuteur secondaire</th><th class="center">Note</th><th></th></tr></thead>
						<?php	
						if($st3->rowCount()==0) {
							?><tr><td><div class="center" style="font-size:120%;"><?php echo "Aucune soutenance notée a été trouvée dans la base de donnée.";?></div></td></tr><?php
						} else {
							while($row3=$st3->fetch()) {
									$stid = intval($row3['stid']);
									$sid = intval($row3['sid']);
									$tuteur1 = htmlspecialchars($row3['tuteur1']);
									$nom1 = htmlspecialchars($row3['nom']);
									$prenom1 = htmlspecialchars($row3['prenom']);
									$tuteur2 = htmlspecialchars($row3['tuteur2']);
									$note = intval($row3['note']);
									
									$SQL4 = "SELECT nom, prenom FROM users
											 WHERE uid=?";
									$st4 = $db->prepare($SQL4);
									$res=$st4->execute(array($tuteur2));
									while($row4=$st4->fetch()) {
										$nom2 = htmlspecialchars($row4['nom']);
										$prenom2 = htmlspecialchars($row4['prenom']);
									?>
									<tr class="center">
										<td><?php echo $stid?></td><?php
										?><td><?php echo $sid;?></td>
										<td><?php echo "$nom1 $prenom1";?></td>
										<td><?php echo "$nom2 $prenom2";?></td>
										<td><?php echo $note; ?></td>
										<td><form action="modif_note_form.php" method="post">
												<?php echo "<input type='hidden' name='sid' value='$sid' />"; 
												 echo "<input type='hidden' name='stid' value='$stid' />"; 
												 echo "<input type='hidden' name='note' value='$note' />";
												 echo "<input type='hidden' name='token' value='$token' />"; ?>
												<button type="submit" class="btn btn-default" style="font-size:80%;">modifier note</button>
											</form>
										</td>
									</tr><?php
									}
							}
						}
						?></table>
					</div>	
				<?php
				$db=null;
			}
			catch(PDOException $e) {
				exit("Erreur de connexion ".$e->getMessage());
			}
	include("../../footer.php");
	?>