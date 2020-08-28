<?php
	require("../../auth/EtreAuthentifie.php");
	$page_title = "Liste des utilisateurs (tuteurs pedagogiques)";
	include("../../header/header_admin.php");
	?>
	<?php
		require("../../db_config.php");
		try {
			$db = new PDO($dsn, $username, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$SQL = "SELECT * FROM users ";
			$st=$db->prepare($SQL);
			$res=$st->execute();
			
			if($st->rowCount()==0) {
				?><div class="center" style="font-size:120%; padding-bottom:200px;"><?php echo "Aucun utilisateur trouvé dans la base de donnée.";?></div><?php
			} else {
				?>
				<div class="table-custom" style="width:80%;margin-left:10%; margin-bottom:100px;">
					<h2>Liste des utilisateurs</h2>
					<p style="color:yellow;"><?php if(isset($_SESSION['mess'])) { echo htmlspecialchars($_SESSION['mess']); unset($_SESSION['mess']); } ?></p>
					</br></br>
					<table class="table center ">
					<thead><tr style="font-size:120%; color:#999999;"><th class="center">user n°</th><th class="center">Nom</th><th class="center">Prénom</th><th class="center">Act/Désact</th><th></th></tr></thead>
						<?php	
						while($row=$st->fetch()) {
							$uid = intval($row['uid']);
							if($row['actif'] == 1) {
									?>
									<tr class="center">
										<td><?php echo $uid?></td><?php
										?><td><?php echo htmlspecialchars($row['nom']);?></td>
										<td><?php echo htmlspecialchars($row['prenom']);?></td>
										<td>actif</td>
										<td><form action="../modification/modif_actif.php" method="post">
												<?php echo "<input type='hidden' name='uid' value='$uid' />" ?>
												<?php echo "<input type='hidden' name='etat' value='1' />" ?>
												<button type="submit" class="btn btn-default" style="font-size:80%;">désactivation</button>
											</form>
										</td>
									</tr>
								<?php
							} else {
								?>
								<tr class="center">
									<td><?php echo $uid?></td><?php
									?><td><?php echo htmlspecialchars($row['nom']);?></td>
									<td><?php echo htmlspecialchars($row['prenom']);?></td>
									<td>non actif</td>
									<td><form action="../modification/modif_actif.php" method="post">
											<?php echo "<input type='hidden' name='uid' value='$uid' />" ?>
											<?php echo "<input type='hidden' name='etat' value='0' />" ?>
											<button type="submit" class="btn btn-default" style="font-size:80%;">activation</button>
										</form>
									</td>
								</tr>
							<?php
							}
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