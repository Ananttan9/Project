<?php
	require("../../auth/EtreAuthentifie.php");
	$page_title = "Liste des stages";
	include("../../header/header_admin.php");
?>
	<?php
		include("../../token.php");
		require("../../db_config.php");
		try {
			$db = new PDO($dsn, $username, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$SQL = "SELECT * FROM stages 
					LEFT JOIN etudiants ON stages.eid = etudiants.eid ";
			$st=$db->prepare($SQL);
			$res=$st->execute();
			
			if($st->rowCount()==0) {
				?><p style="color:yellow; font-size:120%;" class="center"><?php if(isset($_SESSION['mess'])) { echo htmlspecialchars($_SESSION['mess']); unset($_SESSION['mess']); } ?></p>
				<div class="center" style="font-size:120%; padding-bottom:200px;"><?php echo "Aucun stage trouvé dans la base de donnée.";?></div><?php
			} else {
				?>
				<div class="table-custom" style="width:80%;margin-left:10%; margin-bottom:100px;">
					<h2>Liste des stages pour suppression</h2>
					<p style="color:yellow; font-size:120%;"><?php if(isset($_SESSION['mess'])) { echo htmlspecialchars($_SESSION['mess']); unset($_SESSION['mess']); } ?></p>
					</br></br>
					<table class="table center ">
					<thead><tr style="font-size:120%; color:#999999;"><th class="center">Stage n°</th><th class="center">Titre</th><th class="center">Etudiant</th><th class="center">Date début</th><th class="center">Date fin</th><th></th></tr></thead>
						<?php	
						while($row=$st->fetch()) {
							$sid = intval($row['sid']);
							$nom = htmlspecialchars($row['nom']);
							$prenom = htmlspecialchars($row['prenom']);
								?>
								<tr class="center">
									<td><?php echo htmlspecialchars($row['sid']) ?></td>
									<td style="width:350px;"><?php echo htmlspecialchars($row['titre']);?></td>
									<td><?php echo "$nom $prenom" ?></td>
									<td><?php echo htmlspecialchars($row['dateDebut']);?></td>
									<td><?php echo htmlspecialchars($row['dateFin']);?></td>
									<td>
										<a id="mod" data-toggle="modal" href="#myModal<?php echo $sid; ?>" class="suppr"><button class="btn btn-default" style="font-size:70%;">supprimer<span style="font-size:120%; text-align:right; margin-left:10px; color:grey;" class="glyphicon glyphicon-minus-sign"></span></button></a>
										<div id="myModal<?php echo $sid; ?>" class="modal fade" style="margin-top:150px;">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title" style="color:black;font-size:130%;font-weight:bold;">Confirmation</h4>
													</div>
													<div class="modal-body">
														<p style="color:black;">Voulez-vous vraiment supprimer ce stage ?</p>
													</div>
													<div class="modal-footer center">
														<form action="suppr_stage.php" method="post">
															<?php echo "<input type='hidden' name='sid' value='$sid' />" ?>
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
		?>
		<script>
				$(function(){
					$("#mod").on("click", function (){
						$("#myModal2").modal('show')
					});
				});
		</script>
		
		<?php 
	include("../../footer.php");
	?>