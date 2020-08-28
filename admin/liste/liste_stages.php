<?php
	require("../../auth/EtreAuthentifie.php");
	$page_title = "Liste des stages";
	include("../../header/header_admin.php");
	?>
	<?php
	if(!isset($_POST['annee'])) {
		$annee = htmlspecialchars($_SESSION['annee']);
		$annee_form = $annee."-00-00";
		$annee_s = (htmlspecialchars($_SESSION['annee']) + 1);
		$annee_s_form = $annee_s."00-00";
	} else {
		$annee = htmlspecialchars($_POST['annee']);
		$annee_form = $annee."-00-00";
		$annee_s = (htmlspecialchars($_POST['annee']) + 1);
		$annee_s_form = $annee_s."-00-00";
	}
		require("../../db_config.php");
		try {
			$db = new PDO($dsn, $username, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$SQL = "SELECT * FROM stages
					LEFT JOIN users ON stages.tuteurP = users.uid
					WHERE dateDebut > ? AND dateDebut < ?";
			$st=$db->prepare($SQL);
			$res=$st->execute(array($annee_form, $annee_s_form));
			
			if($st->rowCount()==0) {
				?><div class="table-custom" style="width:80%;margin-left:10%; margin-bottom:100px;">
					<div class="row">
					<div class="col-sm-7 right"><h2>Liste des stages de <?php echo $annee; ?></h2></div>
						<div class="col-sm-3 right"><p>année :</p></div>
						<form method="post">
						<div class="col-sm-1 left">
							<select class="form-control" style="width:80px; font-size:80%;padding: 0px 0px; height:25px; margin-top:3px;" name="annee">
								<option value="2019">2019</option>
								<option value="2018">2018</option>
								<option value="2017">2017</option>
								<option value="2016">2016</option>
								<option value="2015">2015</option>
							</select>
						</div>
							<div class="col-sm-1 left"><button type="submit" class="btn btn-default" style="font-size:80%;padding:1px 6px;">ok</button></div>
						</form>
					</div>
					</br></br>
					<?php	
					?><div class="center" style="font-size:120%; padding-bottom:200px;"><?php echo "Aucun stage trouvé dans la base de donnée.";?></div>
					<?php
			} else {
				?>
				<div class="table-custom" style="width:80%;margin-left:10%; margin-bottom:100px;">
					<div class="row">
					<div class="col-sm-7 right"><h2>Liste des stages de <?php echo $annee; ?></h2></div>
						<div class="col-sm-3 right"><p>année :</p></div>
						<form method="post">
						<div class="col-sm-1 left">
							<select class="form-control" style="width:80px; font-size:80%;padding: 0px 0px; height:25px; margin-top:3px;" name="annee">
								<option value="2019">2019</option>
								<option value="2018">2018</option>
								<option value="2017">2017</option>
								<option value="2016">2016</option>
								<option value="2015">2015</option>
							</select>
						</div>
							<div class="col-sm-1 left"><button type="submit" class="btn btn-default" style="font-size:80%;padding:1px 6px;">ok</button></div>
						</form>
					</div>
					</br></br>
					<table class="table center ">
					<thead><tr style="font-size:120%; color:#999999;"><th class="center">Stage n°</th><th class="center">Titre</th><th class="center">Tuteur pédagogique</th><th class="center">Date début</th><th class="center">Date fin</th></tr></thead>
						<?php	
						while($row=$st->fetch()) {
							$nom = htmlspecialchars($row['nom']);
							$prenom = htmlspecialchars($row['prenom']);
									?>
									<tr class="center">
										<td><?php echo htmlspecialchars($row['sid']) ?></td>
										<td style="width:350px;"><?php echo htmlspecialchars($row['titre']);?></td>
										<td><?php echo "$nom $prenom" ?></td>
										<td><?php echo htmlspecialchars($row['dateDebut']);?></td>
										<td><?php echo htmlspecialchars($row['dateFin']);?></td>
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
	<?php
	include("../../footer.php");
	?>