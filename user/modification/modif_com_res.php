<?php
	include("../../auth/EtreAuthentifie.php");
?>
<?php 
if(isset($_POST['commentaire']) && isset($_POST['CSRFToken'])) {
	$token = $_SESSION['token'];
	unset ($_SESSION['token']);
	$token_recu = htmlspecialchars($_POST['CSRFToken']);
	$result = hash_equals($token, $token_recu);
	if(!$result) {
		unset($_POST['CSRFToken']);
		include("modif_com.php");
		exit();
	}
}


foreach (['commentaire', 'sid'] as $name) {
    $clearData[$name] = htmlspecialchars($_POST[$name]);
}

require("../../db_config.php");
	try {
		$db = new PDO($dsn, $username, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$SQL = "UPDATE notes SET commentaire=? WHERE sid=? ";
		$st = $db->prepare($SQL);
		$res = $st->execute(array($clearData['commentaire'], $clearData['sid']));
			
			if($st->rowCount()==0) {
				$_SESSION['mess'] = "modification échouée, veuillez réessayer";
			} else {
				$_SESSION['mess'] = "commentaire du stage modifié";
			}
		
		$db=null;
	} catch (\PDOException $e) {
		http_response_code(500);
		echo "Erreur de serveur: '$e'";
		exit();
	}
	redirect("modif_com.php");
?>