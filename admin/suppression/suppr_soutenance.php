<?php
	require("../../auth/EtreAuthentifie.php");
	$page_title = "Liste des soutenances";
?>
	<?php
	if(!isset($_POST['CSRFToken']) || !isset($_POST['stid'])) {
		?><div class="center" style="font-size:120%; padding-bottom:200px;"><?php echo "Probleme de variable dans la page.";?></div><?php
		exit();
	} else {
		$token = $_SESSION['token'];
		unset($_SESSION['token']);
		$token_recu = htmlspecialchars($_POST['CSRFToken']);
		$result = hash_equals($token, $token_recu);
		if(!$result) {
			exit();
		}
		$stid = intval($_POST['stid']);
		require("../../db_config.php");
		try {
			$db = new PDO($dsn, $username, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$SQL = "DELETE FROM soutenances
					WHERE stid=? ";
			$st=$db->prepare($SQL);
			$res=$st->execute(array($stid));
			
			if($st->rowCount()==0) {
				?><div class="center" style="font-size:120%; padding-bottom:200px;"><?php echo "La suppression a echouée.";?></div><?php
			} else {
				$_SESSION['mess'] = "Soutenance n° $stid supprimée";
			}
			$db=null;
		}
		catch(PDOException $e) {
			exit("Erreur de connexion ".$e->getMessage());
		}
		redirect("suppr_soutenance_form.php");
	}
	?>