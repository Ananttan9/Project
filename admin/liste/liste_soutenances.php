<?php
	require("../../auth/EtreAuthentifie.php");
	$page_title="Liste des soutenances";
	include("../../header/header_admin.php");
	?>
	<?php
		require("../../db_config.php");
		try {
			$db = new PDO($dsn, $username, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$SQL = "SELECT stages.sid sid,stid,etudiants.nom nom,
						   etudiants.prenom prenom,
						   users.nom u1nom, users.prenom u1prenom,
						   tuteur1, tuteur2, date, salle
					FROM soutenances
					JOIN etudiants
					JOIN users ON soutenances.tuteur1 = users.uid
					JOIN stages ON stages.eid = etudiants.eid AND stages.sid = soutenances.sid
					WHERE users.nom = (SELECT nom FROM users WHERE uid=tuteur1)
						AND users.prenom = (SELECT prenom FROM users WHERE uid=tuteur1)
					ORDER BY date";
			$st = $db->prepare($SQL);
			$res=$st->execute();
			if($st->rowCount()==0) {
				?><div class="center" style="font-size:120%; padding-bottom:200px;"><?php echo "Il n'y a aucune données disponible";?></div><?php
			} else {
				?>
				<div class="table-custom" style="width:80%;margin-left:10%;">
					<h2>Liste des soutenances</h2>
					</br></br>
					<table class="table center ">
					<thead><tr style="font-size:120%; color:#999999;"><th class="center">Date</th><th class="center">soutenance n°</th><th class="center">stage n°</th><th class="center">Tuteur principal</th><th class="center">Tuteur secondaire</th><th class="center">Salle</th></tr></thead>
					<?php	
					while($row=$st->fetch()) {
						$tuteur2 = intval($row['tuteur2']);
						$nom1 = htmlspecialchars($row['u1nom']);
						$prenom1 = htmlspecialchars($row['u1prenom']);
						
						$SQL2 = "SELECT nom nom2, prenom prenom2 FROM users
								 WHERE uid=?";
						$st2 = $db->prepare($SQL2);
						$res=$st2->execute(array($tuteur2));
						while($row2=$st2->fetch()) {
							$nom2 = htmlspecialchars($row2['nom2']);
							$prenom2 = htmlspecialchars($row2['prenom2']);
							?>
							<tr class="center">
							<td><?php echo htmlspecialchars ($row['date'])?></td>
								<td><?php echo intval ($row['stid'])?></td>
								<td><?php echo intval ($row['sid'])?></td>
								<td><?php echo "$nom1 $prenom1"; ?></td>
								<td><?php echo "$nom2 $prenom2"; ?></td>
								<td><?php echo htmlspecialchars ($row['salle'])?></td>
							</tr>
							<?php
						}
					}
					?></table>
				</div>
			<?php
			}	
			$db=null;
		}
		catch(PDOException $e) {
		exit("Erreur de connexion ".$e->getMessage());
		}
		?>
		</br></br></br>
	<?php
	include("../../footer.php");
	?>