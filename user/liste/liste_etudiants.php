<?php
	require("../../auth/EtreAuthentifie.php");
	$page_title = "Liste des étudiants en tant que tuteur pédagogique";
	include("../../header/header_user.php");
	?>
	<?php
		require("../../db_config.php");
		$uid = htmlspecialchars($_SESSION['uid']);
		if(!isset($_SESSION['actif']) || $_SESSION['actif'] == 0) {
			?><div class="center" style="font-size:120%;color:green;margin-top:200px;margin-left:30%;background:#e6e6e6;padding:10px 10px 10px 10px;width:40%;">
				<?php echo "Vous n'avez pas l'authorisation, vous avez été désactivé";?>
			</div><?php
			exit();
		} else if($_SESSION['actif'] == 1) {
			try {
				$db = new PDO($dsn, $username, $password);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$SQL = "SELECT * FROM etudiants
						WHERE eid IN (SELECT eid FROM stages WHERE tuteurP=?) ";
				$st = $db->prepare($SQL);
				$res=$st->execute(array($uid));
					?>
					<div class="table-custom" style="width:60%;margin-left:15%;">
						<h2>Tuteur pédagogique des étudiants suivants</h2>
						</br></br>
						<table class="table center ">
						<?php if($st->rowCount()==0) {
							?><tr>Aucun etudiant trouvé.<br>Vous n'êtes le tuteur pédagogique d'aucun étudiant.</tr><?php
						} else {
							?>
							<thead><tr style="font-size:120%; color:#999999;"><th class="center">Nom</th><th class="center">Prénom</th><th class="center">Email</th></tr></thead>
							<?php	
							while($row=$st->fetch()) {
								?>
								<tr class="center">
									<td><?php echo htmlspecialchars ($row['nom'])?></td>     
									<td><?php echo htmlspecialchars ($row['prenom'])?></td>
									<td><?php echo htmlspecialchars ($row['email'])?></td>
								</tr>
								<?php
							}
						}
						?></table>
						</br>
					</div>
					<?php
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
	