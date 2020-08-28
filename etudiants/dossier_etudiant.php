
	<?php
		require("../db_config.php");
		$error2 = "";
			try {
				$dossier = htmlspecialchars($_SESSION['dossier']);
				$db = new PDO($dsn, $username, $password);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$SQL = "SELECT nom, prenom FROM etudiants
						WHERE eid=?";
				$st = $db->prepare($SQL);
				$res1 = $st->execute(array($dossier));
				if($st->rowCount()==0) {
					$error2 = "Désolé, le numéro de dossier n'existe pas."."<br>";
					include("../connexion/login_form.php");
					exit();
				}
				$db = new PDO($dsn, $username, $password);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$SQL = "SELECT tuteur1, tuteur2, date, salle, note, commentaire FROM soutenances
						CROSS JOIN notes
						ON soutenances.sid = notes.sid
						WHERE soutenances.sid IN (SELECT sid FROM stages WHERE eid=?)";
				$st1 = $db->prepare($SQL);
				$res1 = $st1->execute(array($dossier));
				if($st1->rowCount()==0) {
					$SQL = "SELECT tuteur1, tuteur2, date, salle FROM soutenances
							WHERE sid IN (SELECT sid FROM stages WHERE eid=?)";
					$st2 = $db->prepare($SQL);
					$res2 = $st2->execute(array($dossier));
					if($st2->rowCount()==0) {
						?><p class="center" style="margin-top:150px; font-size:120%;">Il n'y a aucune données pour le moment</p><?php
					} else {
						?>
						</br></br>
						<div class="table-custom">
						<?php while($row=$st2->fetch()) { ?>
							<table class="table center">
								<tr><td style="border-right:1px solid white; width:250px;">Tuteurs pédagogiques</td><td><ul style="margin-left:170px; text-align:left;"><li><?php echo "tuteur ";echo htmlspecialchars($row['tuteur1']);?></li><li><?php echo "tuteur "; echo htmlspecialchars($row['tuteur2']); ?></li></ul></td></tr>
								<tr><td style="border-right:1px solid white;">date de la soutenance</td><td><?php echo htmlspecialchars($row['date']); ?></td></tr>
								<tr><td style="border-right:1px solid white;">Salle pour la soutenance</td><td><?php echo htmlspecialchars($row['salle']); ?></td></tr>
								<tr><td style="border-right:1px solid white;">Note</td><td>-</td></tr>
								<tr style="border-bottom:1px solid white;"><td style="border-right:1px solid white;">Commentaire</td><td>-</td></tr>
							</table>
						</div>
						<?php
						}
					}
				} else {
					?>
					</br></br>
					<div class="table-custom">
					<?php while($row=$st1->fetch()) { ?>
						<table class="table center">
							<tr><td style="border-right:1px solid white; width:250px;">Tuteurs pédagogiques</td><td><ul style="margin-left:170px; text-align:left;"><li><?php echo "tuteur ";echo htmlspecialchars($row['tuteur1']);?></li><li><?php echo "tuteur "; echo htmlspecialchars($row['tuteur2']); ?></li></ul></td></tr>
							<tr><td style="border-right:1px solid white;">date de la soutenance</td><td><?php echo htmlspecialchars($row['date']); ?></td></tr>
							<tr><td style="border-right:1px solid white;">Salle pour la soutenance</td><td><?php echo htmlspecialchars($row['salle']); ?></td></tr>
							<tr><td style="border-right:1px solid white;">Note</td><td><?php echo intval($row['note']); ?></td></tr>
							<tr style="border-bottom:1px solid white;"><td style="border-right:1px solid white;">Commentaire</td><td><?php echo htmlspecialchars($row['commentaire']); ?></td></tr>
						</table>
					</div>
					<?php
						}
				}
				$db=null;
			}
			catch(PDOException $e) {
				exit("Erreur de connexion ".$e->getMessage());
			}
			?>
			</br></br>
	<?php
	include("../footer.php");
	?>
	