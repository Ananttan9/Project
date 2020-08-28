<?php
	require("../../auth/EtreInvite.php");
	$page_title="Liste des notes des étudiants";
	include("../../header/header_index.php");
	?>
	<?php
	if(!isset($_GET['token'])) {
		redirect($pathFor['login']);
	} else {
		$token_recu = htmlspecialchars($_GET['token']);
		require("../../db_config.php");
		try {
			$db = new PDO($dsn, $username, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$SQL = "SELECT * FROM gestionnaires ";
			$st = $db->prepare($SQL);
			$res=$st->execute();
			$test = 0;
			while($row=$st->fetch()) {
				$token = htmlspecialchars($row['token']);
				if($token == $token_recu) {
					$test = 10;
					break;
				}
			}
			if($test != 10) {
				redirect($pathFor['login']);
			}
			if(isset($_POST['triDate'])) {
				$SQL = "SELECT date, nom, prenom, note FROM soutenances
				JOIN etudiants
				JOIN stages ON stages.eid = etudiants.eid AND stages.sid = soutenances.sid
				JOIN notes ON soutenances.sid = notes.sid
				ORDER BY date";
			} else {
				$SQL = "SELECT date, nom, prenom, note FROM soutenances
				JOIN etudiants
				JOIN stages ON stages.eid = etudiants.eid AND stages.sid = soutenances.sid
				JOIN notes ON soutenances.sid = notes.sid
				ORDER BY nom";
			}
			$st = $db->prepare($SQL);
			$res=$st->execute();
				?>
				<div class="table-custom" style="width:60%;margin-left:20%; margin-bottom: 200px;">
					<h2>Liste des notes des étudiants</h2>
						<div class="row"><p class="col-sm-6 right">Trié par : </p>
							<form method="post" class="col-sm-1 center">
								<input type="hidden" name="triNom" />
								<button style="background:#4d4d4d; border:2px solid grey; border-radius:5px;" type="submit">nom</button>
							</form>
							<form method="post" class="col-sm-1 left">
								<input type="hidden" name="triDate" />
								<button style="background:#4d4d4d; border:2px solid grey; border-radius:5px;" type="submit">date</button>
							</form>
						</div>
					</br></br>
					<?php if($st->rowCount()==0) {
						?><div class="center" style="font-size:120%; padding-bottom:200px;"><?php echo "Il n'y a aucune données disponibles";?></div><?php
					} else {
						?><table class="table center" id="myTable">
						<thead><tr style="font-size:120%; color:#999999;"><th class="center">Nom</th><th class="center">Prénom</th><th class="center">Date soutenance</th><th class="center">Note</th></tr></thead>
						<?php	
						while($row=$st->fetch()) {
							?>
							<tr class="center">
								<td><?php echo htmlspecialchars ($row['nom'])?></td>     
								<td><?php echo htmlspecialchars ($row['prenom'])?></td>
								<td><?php echo htmlspecialchars ($row['date'])?></td>
								<td><?php echo intval ($row['note'])?></td>
							</tr>
							<?php
						}
					?></table>
					<?php } ?>
				</div>
			<?php	
			$db=null;
		}
		catch(PDOException $e) {
		exit("Erreur de connexion ".$e->getMessage());
		}
	}
		?>
		
		</br></br></br>
	<?php
	include("../../footer.php");
	?>
	