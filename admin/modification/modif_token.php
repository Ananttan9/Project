<?php
	require("../../auth/EtreAuthentifie.php");
	$page_title="Modification du token";
	include("../../header/header_admin.php");
?>
		<?php
		$error = "";
		require("../../db_config.php");
				include("../../token.php");
				$db = new PDO($dsn, $username, $password);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$SQL = "SELECT * FROM gestionnaires ";
				$st=$db->prepare($SQL);
				$res=$st->execute();
				
				if($st->rowCount()==0) {
					?><div class="center" style="font-size:120%; padding-bottom:200px;"><?php echo "Aucun gestionnaire trouvé dans la base de donnée.";?></div><?php
				} else {
					?>
					<div class="table-custom" style="width:70%;margin-left:15%; margin-bottom:100px;">
						<h2>Liste des gestionnaires :</h2>
						<p style="color:yellow;"><?php if(isset($_SESSION['mess'])) { echo htmlspecialchars($_SESSION['mess']); unset($_SESSION['mess']); } ?></p>
						<p style="color:yellow;"><?php if(isset($_SESSION['mess2'])) { echo htmlspecialchars($_SESSION['mess2']); unset($_SESSION['mess2']); } ?></p>
						</br></br>
						<table class="table center ">
						<thead><tr style="font-size:120%; color:#999999;"><th class="center">gestionnaire n°</th><th class="center">Nom</th><th class="center">Prénom</th><th></th></tr></thead>
							<?php	
							while($row=$st->fetch()) {
								$gid = intval($row['gid']);
								?>
								<tr class="center">
									<td><?php echo $gid?></td><?php
									?><td><?php echo htmlspecialchars($row['nom']);?></td>
									<td><?php echo htmlspecialchars($row['prenom']);?></td>
									<td><form action="modif_token_res.php" method="post">
											<?php echo "<input type='hidden' name='gid' value='$gid' />" ?>
											<?php echo "<input type='hidden' name='CSRFToken' value='$token' />" ?>
											<button type="submit" class="btn btn-default" style="font-size:80%;">renouveler le token</button>
										</form>
									</td>
								</tr><?php
							}
						?></table>
					</div><?php 
				}
	
	include("../../footer.php");
	?>