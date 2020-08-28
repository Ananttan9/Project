<?php
	require("../../auth/EtreAuthentifie.php");
	$page_title = "Liste des gestionnaires";
	include("../../header/header_admin.php");
?>
	<?php
		include("../../token.php");
		require("../../db_config.php");
		try {
			$db = new PDO($dsn, $username, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$SQL = "SELECT * FROM gestionnaires ";
			$st=$db->prepare($SQL);
			$res=$st->execute();
			
			if($st->rowCount()==0) {
				?><p style="color:yellow; font-size:120%;" class="center"><?php if(isset($_SESSION['mess'])) { echo htmlspecialchars($_SESSION['mess']); unset($_SESSION['mess']); } ?></p>
				<div class="center" style="font-size:120%; padding-bottom:200px;"><?php echo "Aucun stage trouvé dans la base de donnée.";?></div><?php
			} else {
				?>
				<div class="table-custom" style="width:80%;margin-left:10%; margin-bottom:100px;">
					<h2>Liste des gestionnaires pour suppression</h2>
					<p style="color:yellow; font-size:120%;"><?php if(isset($_SESSION['mess'])) { echo htmlspecialchars($_SESSION['mess']); unset($_SESSION['mess']); } ?></p>
					</br></br>
					<table class="table center ">
					<thead><tr style="font-size:120%; color:#999999;"><th class="center">Gestionnaire n°</th><th class="center">Nom</th><th class="center">Prénom</th><th class="center">Email</th><th></th></tr></thead>
						<?php	
						while($row=$st->fetch()) {
							$gid = intval($row['gid']);
							?>
							<tr class="center">
								<td><?php echo intval($row['gid']) ?></td>
								<td><?php echo htmlspecialchars($row['nom']);?></td>
								<td><?php echo htmlspecialchars($row['prenom']);?></td>
								<td><?php echo htmlspecialchars($row['email']);?></td>
								<td>
									<a id="mod" data-toggle="modal" href="#myModal<?php echo $gid; ?>" class="suppr"><button class="btn btn-default" style="font-size:70%;">supprimer<span style="font-size:120%; text-align:right; margin-left:10px; color:grey;" class="glyphicon glyphicon-minus-sign"></span></button></a>
									<div id="myModal<?php echo $gid; ?>" class="modal fade" style="margin-top:150px;">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title" style="color:black;font-size:130%;font-weight:bold;">Confirmation</h4>
												</div>
												<div class="modal-body">
													<p style="color:black;">Voulez-vous vraiment supprimer ce gestionnaire ?</p>
												</div>
												<div class="modal-footer center">
													<form action="suppr_gestionnaire.php" method="post">
														<?php echo "<input type='hidden' name='gid' value='$gid' />" ?>
														<?php echo "<input type='hidden' name='CSRFToken' value='$token' />" ?>
														<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
														<input type="submit" class="btn btn-primary" value="Confirmer">
													</form>
												</div>
											</div> 
										</div>
									</div>
								</td>
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
		
	include("../../footer.php");
	?>