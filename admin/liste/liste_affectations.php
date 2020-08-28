<?php
	require("../../auth/EtreAuthentifie.php");
	$page_title = "Liste des affectations des tuteurs pédagogiques pour les stages";
	include("../../header/header_admin.php");
	?>
	<?php
		require("../../db_config.php");
		try {
			$db = new PDO($dsn, $username, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$SQL = "SELECT * FROM stages
					JOIN users ON stages.tuteurP = users.uid
					 ";
			$st=$db->prepare($SQL);
			$res=$st->execute();
			
			if($st->rowCount()==0) {
				?><div class="center" style="font-size:120%; padding-bottom:200px;"><?php echo "Aucun stage trouvé dans la base de donnée.";?></div><?php
			} else {
				?>
				<div class="table-custom" style="width:80%;margin-left:10%; margin-bottom:100px;">
					<h2>Liste des affectations</h2>
					</br></br>
					<table class="table center ">
					<thead><tr style="font-size:120%; color:#999999;"><th class="center">Stage n°</th><th class="center">Tuteur pédagogique</th><th class="center">Titre</th><th class="center">Date début</th><th class="center">Date fin</th></tr></thead>
						<?php	
						while($row=$st->fetch()) {
							$nom = htmlspecialchars($row['nom']);
							$prenom = htmlspecialchars($row['prenom']);
									?>
									<tr class="center">
										<td><?php echo htmlspecialchars($row['sid']) ?></td>
										<td><?php echo "$nom $prenom" ?></td>
										<td style="width:350px;"><?php echo htmlspecialchars($row['titre']);?></td>
										<td><?php echo htmlspecialchars($row['dateDebut']);?></td>
										<td><?php echo htmlspecialchars($row['dateFin']);?></td>
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
			exit("Erreur de connexion ".$e->getMessage());
		}

		?>
	<?php
	include("../../footer.php");
	?>