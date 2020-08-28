</br>
<div class="center">
		<?php
		require("../../db_config.php");
			try {
				$db = new PDO($dsn, $username, $password);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$SQL = "SELECT * FROM stages
						JOIN etudiants ON stages.eid = etudiants.eid
						WHERE sid NOT IN (SELECT sid FROM stages
										  JOIN users ON stages.tuteurP = users.uid)
						";
				$st=$db->prepare($SQL);
				$res=$st->execute();
				
				if($st->rowCount()==0) {
					?><div class="center" style="font-size:120%; padding-bottom:200px;"><?php echo "Aucun stage disponible pour une affectation.";?></div><?php
				} else {
					?>
					<div class="table-custom" style="width:80%;margin-left:10%; margin-bottom:100px;">
						<h2>Affectation de tuteur à un stage</h2>
						</br></br>
						<table class="table center ">
						<thead><tr style="font-size:120%; color:#999999;"><th class="center">Stage n°</th><th class="center">Titre</th><th class="center">Etudiant</th><th class="center">Tuteur pédagogique</th><th></th></tr></thead>
							<?php	
							while($row=$st->fetch()) {
								$nom = htmlspecialchars($row['nom']);
								$prenom = htmlspecialchars($row['prenom']);
										?>
										<tr class="center">
											<td style="width:150px;"><?php echo htmlspecialchars($row['sid']) ?></td>
											<td><?php echo htmlspecialchars($row['titre']);?></td>
											<td><?php echo "$nom $prenom" ?></td>
											<form method="post">
												<td style="width:200px;">
													<select class="form-control" name="uid" required>
														<option value="">-selectionner un tuteur-</option>
														<?php 
															$SQL2 = "SELECT * FROM users
																	 WHERE actif = 1
																	";
															$st2=$db->prepare($SQL2);
															$res=$st2->execute();
															
															while($row2=$st2->fetch()) {
															$nomP = htmlspecialchars($row2['nom']);
															$prenomP = htmlspecialchars($row2['prenom']);
															$uid = intval($row2['uid']);
															?><option value="<?php echo $uid; ?>"><?php echo "$uid. $nomP $prenomP";?></option>
														<?php } ?>
													</select>
												</td>
												<?php $sid = intval($row['sid']);
													echo "<input type='hidden' name='sid' value='$sid' />";
													echo "<input type='hidden' name='CSRFToken' value='$token' />"; ?>
												<td><div class="form-group">
														<button type="submit" class="btn btn-default" style="font-size:80%;">Valider</button>
													</div>
												</td>
											</form>
										</tr>
									<?php
							} ?>
						</table>
					</div>
					</br>
				<?php
				}
				$db=null;
			}
			catch(PDOException $e) {
				exit("Erreur de connexion ".$e->getMessage());
			}
			?>