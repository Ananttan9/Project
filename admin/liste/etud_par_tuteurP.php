<?php
	require("../../auth/EtreAuthentifie.php");
	$page_title = "Liste des statistiques concernant le nombre d'étudiants par tuteurs pédagogique";
	include("../../header/header_admin.php");
	?>
	<?php
		require("../../db_config.php");
		try {
			$db = new PDO($dsn, $username, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$SQL = "SELECT uid, nom, prenom, COUNT(eid) nb FROM stages
					JOIN users ON stages.tuteurP = users.uid
					GROUP BY uid ";
			$st=$db->prepare($SQL);
			$res=$st->execute();
			
			if($st->rowCount()==0) {
				?><div class="center" style="font-size:120%; padding-bottom:200px;"><?php echo "Aucune correspondance tuteur-étudiants trouvée dans la base de donnée.";?></div><?php
			} else {
				?>
				<div class="table-custom" style="width:50%;margin-left:25%; margin-bottom:100px;">
					<h2>Nombre d'étudiants par tuteur pédagogique</h2>
					</br></br>
					<table class="table center ">
					<thead><tr style="font-size:120%; color:#999999;"><th class="center">Numéro du tuteur</th><th class="center">Tuteur pédagogique</th><th class="center">Nb d'étudiants</th></tr></thead>
						<?php	
						while($row=$st->fetch()) {
							$nom = htmlspecialchars($row['nom']);
							$prenom = htmlspecialchars($row['prenom']);
							$nb = intval($row['nb']);
									?>
									<tr class="center">
										<td><?php echo htmlspecialchars($row['uid']) ?></td>
										<td><?php echo "$nom $prenom"; ?></td>
										<td><?php echo "$nb"; ?></td>
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