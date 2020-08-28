<?php
	require("../../auth/EtreAuthentifie.php");
	$page_title="Modification du tuteur";
	include("../../header/header_admin.php");
	?>
		<?php
		$error = "";
		require("../../db_config.php");
				include("../../token.php");
				$db = new PDO($dsn, $username, $password);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$SQL = "SELECT * FROM stages
						JOIN users ON stages.tuteurP = users.uid ";
				$st=$db->prepare($SQL);
				$res=$st->execute();
				
				if($st->rowCount()==0) {
					?><div class="center" style="font-size:120%; padding-bottom:200px;"><?php echo "Aucun stage avec tuteur trouvé dans la base de donnée.";?></div><?php
				} else {
					?>
					<div class="table-custom" style="width:60%;margin-left:20%; margin-bottom:100px;">
						<h2>Liste des stages et des tuteurs</h2>
						<p style="color:yellow;"><?php if(isset($_SESSION['mess'])) { echo htmlspecialchars($_SESSION['mess']); unset($_SESSION['mess']); } ?></p>
						</br></br>
						<table class="table center ">
						<thead><tr style="font-size:120%; color:#999999;"><th class="center">Stage n°</th><th class="center">Titre</th><th class="center">Tuteur pédagogique</th><th></th></tr></thead>
							<?php	
							while($row=$st->fetch()) {
								$uid = intval($row['uid']);
								$sid = intval($row['sid']);
								$nom = htmlspecialchars($row['nom']);
								$prenom = htmlspecialchars($row['prenom']);
								?>
								<tr class="center">
									<td><?php echo $sid?></td><?php
									?><td><?php echo htmlspecialchars($row['titre']);?></td>
									<td><?php echo "$nom $prenom";?></td>
									<td><form action="modif_affectations_form.php" method="post">
											<?php echo "<input type='hidden' name='sid' value='$sid' />"; 
											 echo "<input type='hidden' name='uid' value='$uid' />"; 
											 echo "<input type='hidden' name='nom' value='$nom' />";
											 echo "<input type='hidden' name='prenom' value='$prenom' />";
											 echo "<input type='hidden' name='token' value='$token' />"; ?>
											<button type="submit" class="btn btn-default" style="font-size:80%;">modifier tuteur</button>
										</form>
									</td>
								</tr><?php
							}
						?></table>
					</div><?php 
				}
		?>
	<?php
	include("../../footer.php");
	?>