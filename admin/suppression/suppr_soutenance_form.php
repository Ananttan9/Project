<?php
	require("../../auth/EtreAuthentifie.php");
	$page_title = "Liste des soutenances pour etre supprimées";
	include("../../header/header_admin.php");
?>
	<?php
		include("../../token.php");
		require("../../db_config.php");
		try {
			$db = new PDO($dsn, $username, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$SQL = "SELECT sid,stid,
						   users.nom u1nom, users.prenom u1prenom,
						   tuteur1, tuteur2, date, salle
					FROM soutenances
					JOIN users ON soutenances.tuteur1 = users.uid
					WHERE users.nom = (SELECT nom FROM users WHERE uid=tuteur1)
						AND users.prenom = (SELECT prenom FROM users WHERE uid=tuteur1)
					ORDER BY stid";
			$st=$db->prepare($SQL);
			$res=$st->execute();
			
			if($st->rowCount()==0) {
				?><p style="color:orange; font-size:120%;" class="center"><?php if(isset($_SESSION['mess'])) { echo htmlspecialchars($_SESSION['mess']); unset($_SESSION['mess']); } ?></p>
				<div class="center" style="font-size:120%; padding-bottom:200px;"><?php echo "Aucune soutenance trouvée dans la base de donnée.";?></div><?php
			} else {
				?>
				<div class="table-custom" style="width:80%;margin-left:10%; margin-bottom:100px;">
					<h2>Liste des soutenances pour suppression</h2>
					<p style="color:yellow; font-size:120%;"><?php if(isset($_SESSION['mess'])) { echo htmlspecialchars($_SESSION['mess']); unset($_SESSION['mess']); } ?></p>
					</br></br>
					<table class="table center ">
					<thead><tr style="font-size:120%; color:#999999;"><th class="center">Stid n°</th><th class="center">Stage n°</th><th class="center">Tut princip.</th><th class="center">Tut second.</th><th class="center">Date</th><th class="center">Salle</th><th></th></tr></thead>
					<?php	
					while($row=$st->fetch()) {
						$tuteur2 = intval($row['tuteur2']);
						$nom1 = htmlspecialchars($row['u1nom']);
						$prenom1 = htmlspecialchars($row['u1prenom']);
						
						$SQL2 = "SELECT nom nom2, prenom prenom2 FROM users
								 WHERE uid=?";
						$st2 = $db->prepare($SQL2);
						$res=$st2->execute(array($tuteur2));
						while($row2=$st2->fetch()) {
							$nom2 = htmlspecialchars($row2['nom2']);
							$prenom2 = htmlspecialchars($row2['prenom2']);
							$stid = htmlspecialchars($row['stid']);
							?>
							<tr class="center">
								<td><?php echo $stid ?></td>
								<td><?php echo intval ($row['sid'])?></td>
								<td><?php echo "$nom1 $prenom1"; ?></td>
								<td><?php echo "$nom2 $prenom2"; ?></td>
								<td><?php echo htmlspecialchars($row['date'])?></td>
								<td><?php echo htmlspecialchars ($row['salle'])?></td>
								<td>
									<a id="mod" data-toggle="modal" href="#myModal<?php echo $stid; ?>" class="suppr"><button class="btn btn-default" style="font-size:70%;">supprimer<span style="font-size:120%; text-align:right; margin-left:10px; color:grey;" class="glyphicon glyphicon-minus-sign"></span></button></a>
									<div id="myModal<?php echo $stid; ?>" class="modal fade" style="margin-top:150px;">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title" style="color:black;font-size:130%;font-weight:bold;">Confirmation</h4>
												</div>
												<div class="modal-body">
													<p style="color:black;">Voulez-vous vraiment supprimer cette soutenance ?</p>
												</div>
												<div class="modal-footer center">
													<form action="suppr_soutenance.php" method="post">
														<?php echo "<input type='hidden' name='stid' value='$stid' />" ?>
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
		
	include("../../footer.php");
	?>