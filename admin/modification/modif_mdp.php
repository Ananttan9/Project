<?php
	require("../../auth/EtreAuthentifie.php");
	$page_title="Modification du mot de passe";
	include("../../header/header_admin.php");
?>
		<?php
		$error = "";
		require("../../db_config.php");
				include("../../token.php");
				$db = new PDO($dsn, $username, $password);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$SQL = "SELECT * FROM users ";
				$st=$db->prepare($SQL);
				$res=$st->execute();
				
				if($st->rowCount()==0) {
					?><div class="center" style="font-size:120%; padding-bottom:200px;"><?php echo "Aucun utilisateur trouvé dans la base de donnée.";?></div><?php
				} else {
					?>
					<div class="table-custom" style="width:70%;margin-left:15%; margin-bottom:100px;">
						<h2>Liste des utilisateurs :</h2>
						<p style="color:yellow;"><?php if(isset($_SESSION['mess'])) { echo htmlspecialchars($_SESSION['mess']); unset($_SESSION['mess']); } ?></p>
						<p style="color:yellow;"><?php if(isset($_SESSION['error'])) { echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); } ?></p>
						</br></br>
						<table class="table center ">
						<thead><tr style="font-size:120%; color:#999999;"><th class="center">user n°</th><th class="center">Nom</th><th class="center">Prénom</th><th></th></tr></thead>
							<?php	
							while($row=$st->fetch()) {
								$uid = intval($row['uid']);
								?>
								<tr class="center">
									<td><?php echo $uid?></td><?php
									?><td><?php echo htmlspecialchars($row['nom']);?></td>
									<td><?php echo htmlspecialchars($row['prenom']);?></td>
									<td><form action="modif_mdp_form.php" method="post">
											<?php echo "<input type='hidden' name='uid' value='$uid' />" ?>
											<?php echo "<input type='hidden' name='token' value='$token' />" ?>
											<button type="submit" class="btn btn-default" style="font-size:80%;">modifier mdp</button>
										</form>
									</td>
								</tr><?php
							}
						?></table>
					</div><?php 
				}
	
	include("../../footer.php");
	?>