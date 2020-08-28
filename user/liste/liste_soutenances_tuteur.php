<?php
	require("../../auth/EtreAuthentifie.php");
	$page_title = "Liste des soutenance en tant que tuteur principal ou secondaire";
	include("../../header/header_user.php");
	?>
	<?php
		require("../../db_config.php");
		$uid = htmlspecialchars($_SESSION['uid']);
		$nom = htmlspecialchars($_SESSION['nom']);
		$prenom = htmlspecialchars($_SESSION['prenom']);
		if(!isset($_SESSION['actif']) || $_SESSION['actif'] == 0) {
			?><div class="center" style="font-size:120%;color:yellow;margin-top:200px;margin-left:30%;background:#e6e6e6;padding:10px 10px 10px 10px;width:40%;">
				<?php echo "Vous n'avez pas l'authorisation, vous avez été désactivé";?>
			</div><?php
			exit();
		} else if($_SESSION['actif'] == 1) {

			try {
			$db = new PDO($dsn, $username, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$SQL = "SELECT * FROM soutenances
					JOIN users
					ON soutenances.tuteur2 = users.uid
					WHERE tuteur1=? ";
			$st=$db->prepare($SQL);
			$res=$st->execute(array($uid));
			
			$SQL = "SELECT * FROM soutenances
					JOIN users
					ON soutenances.tuteur1 = users.uid
					WHERE tuteur2=? ";
			$st2=$db->prepare($SQL);
			$res=$st2->execute(array($uid));
			
			if($st->rowCount()==0) {
				?>
				<div class="table-custom" style="width:50%;margin-left:20%; margin-bottom:100px;">
					<h2>Soutenances en tuteur principal :</h2>
					</br>
					<table class="table center ">
						<tr class="center" style="height:60px;">
							Vous n'êtes tuteur principal dans aucune soutenance
						</tr>
					</table>
				</div>
				<?php
			} else {
				?>
				<div class="table-custom" style="width:80%;margin-left:10%; margin-bottom:100px;">
					<h2>Soutenances en tuteur principal :</h2>
					</br></br>
					<table class="table center ">
					<thead><tr style="font-size:120%; color:#999999;"><th class="center">Stage n°</th><th class="center">Tuteur principal</th><th class="center">Tuteur secondaire</th><th class="center">Date</th><th class="center">Salle</th></tr></thead>
						<?php	
						while($row=$st->fetch()) {
							?>
							<tr class="center">
								<td><?php echo intval ($row['sid'])?></td><?php
									$nom2 = htmlspecialchars($row['nom']);
									$prenom2 = htmlspecialchars($row['prenom']);
									?><td><?php echo "$nom $prenom";?></td>
									<td><?php echo "$nom2 $prenom2";?></td>
								<td><?php echo htmlspecialchars ($row['date'])?></td>
								<td><?php echo htmlspecialchars ($row['salle'])?></td>
							</tr>
						<?php } ?>
					</table>
				</div>
					<?php
			}
			
			if($st2->rowCount()==0) {
				?>
				<div class="table-custom" style="width:50%;margin-left:20%;">
					<h2>Soutenances en tuteur secondaire :</h2>
					</br>
					<table class="table center ">
						<tr class="center" style="height:60px;">
							Vous n'êtes tuteur secondaire dans aucune soutenance
						</tr>
					</table>
				</div>
				<?php
			} else {
				?>
				<div class="table-custom" style="width:80%;margin-left:10%;">
					<h2>Soutenances en tuteur secondaire :</h2>
					</br></br>
					<table class="table center ">
					<thead><tr style="font-size:120%; color:#999999;"><th class="center">Stage n°</th><th class="center">Tuteur principal</th><th class="center">Tuteur secondaire</th><th class="center">Date</th><th class="center">Salle</th></tr></thead>
						<?php	
						while($row=$st2->fetch()) {
							?>
							<tr class="center">
								<td><?php echo intval ($row['sid'])?></td><?php
								$nom2 = htmlspecialchars($row['nom']);
								$prenom2 = htmlspecialchars($row['prenom']);?>
								<td><?php echo "$nom2 $prenom2";?></td>
								<td><?php echo "$nom $prenom"; ?></td>
								<td><?php echo htmlspecialchars ($row['date'])?></td>
								<td><?php echo htmlspecialchars ($row['salle'])?></td>
							</tr>
							<?php
						}
						?>
					</table>
				</div>
					<?php
			}
				
			$db=null;
			}
			catch(PDOException $e) {
				exit("Erreur de connexion ".$e->getMessage());
			}
		}
		?>
	<?php
	include("../../footer.php");
	?>