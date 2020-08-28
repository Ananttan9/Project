<?php
	require("../../auth/EtreAuthentifie.php");
	$page_title = "Liste des stages";
?>
	<?php
	if(!isset($_POST['CSRFToken']) || !isset($_POST['sid'])) {
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
		$sid = intval($_POST['sid']);
		require("../../db_config.php");
		try {
			$db = new PDO($dsn, $username, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$SQL = "DELETE FROM stages 
					WHERE sid=? ";
			$st=$db->prepare($SQL);
			$res=$st->execute(array($sid));
			
			if($st->rowCount()==0) {
				?><div class="center" style="font-size:120%; padding-bottom:200px;"><?php echo "La suppression a echouée.";?></div><?php
			} else {
				$_SESSION['mess'] = "Stage n° $sid supprimé";
			}
			$db=null;
		}
		catch(PDOException $e) {
			exit("Erreur de connexion ".$e->getMessage());
		}
		redirect("suppr_stage_form.php");
	}
	?>