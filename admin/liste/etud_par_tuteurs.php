<?php
	require("../../auth/EtreAuthentifie.php");
	$page_title = "Liste des statistiques concernant le nombre d'étudiants par tuteurs principal et secondaire";
	include("../../header/header_admin.php");
	?>
	<?php
		require("../../db_config.php");
		try {
			$db = new PDO($dsn, $username, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$SQL = "SELECT uid, nom, prenom FROM soutenances
					JOIN users ON soutenances.tuteur1 = users.uid OR soutenances.tuteur2 = users.uid
					GROUP BY uid ";
			$st=$db->prepare($SQL);
			$res=$st->execute();
			
			if($st->rowCount()==0) {
				?><div class="center" style="font-size:120%; padding-bottom:200px;"><?php echo "Aucune correspondance tuteur-étudiants trouvée dans la base de donnée.";?></div><?php
			} else {
				?>
				<div class="table-custom" style="width:70%;margin-left:15%; margin-bottom:100px;">
					<h2>Nombre d'étudiants par tuteurs (soutenances)</h2>
					</br></br>
					<table class="table center ">
					<thead><tr style="font-size:120%; color:#999999;"><th class="center">Numéro du tuteur</th><th class="center">Tuteur</th><th class="center">En tant que tuteur principal</th><th class="center">En tant que tuteur secondaire</th></tr></thead>
						<?php	
						while($row=$st->fetch()) {
							$uid = intval($row['uid']);
							$SQL2 = "SELECT COUNT(tuteur1) nb1 FROM soutenances
									 JOIN users ON soutenances.tuteur1 = users.uid
									 WHERE uid=?";
							$st2=$db->prepare($SQL2);
							$res=$st2->execute(array($uid));
							
							$SQL3 = "SELECT COUNT(tuteur2) nb2 FROM soutenances
									 JOIN users ON soutenances.tuteur2 = users.uid
									 WHERE uid=?";
							$st3=$db->prepare($SQL3);
							$res=$st3->execute(array($uid));
							
							$nom = htmlspecialchars($row['nom']);
							$prenom = htmlspecialchars($row['prenom']);
							$row2=$st2->fetch();
							$nb1 = intval($row2['nb1']);
							$row3=$st3->fetch();
							$nb2 = intval($row3['nb2']);
									?>
									<tr class="center">
										<td><?php echo htmlspecialchars($row['uid']) ?></td>
										<td><?php echo "$nom $prenom"; ?></td>
										<td><?php echo "$nb1"; ?></td>
										<td><?php echo "$nb2"; ?></td>
									</tr>
								<?php
						} ?>
					</table>
				</div>
					<?php
			}
			$db=null;
		}
		catch(PDOException $e) {
			?></br></br><?php
			exit("Erreur de connexion ".$e->getMessage());
		}

		?>
	<?php
	include("../../footer.php");
	?>