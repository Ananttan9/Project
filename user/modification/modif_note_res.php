<?php
	include("../../auth/EtreAuthentifie.php");
?>
<?php 
if(isset($_POST['note']) && isset($_POST['CSRFToken'])) {
	$token = $_SESSION['token'];
	unset ($_SESSION['token']);
	$token_recu = htmlspecialchars($_POST['CSRFToken']);
	$result = hash_equals($token, $token_recu);
	if(!$result) {
		unset($_POST['CSRFToken']);
		include("modif_note.php");
		exit();
	}
}


foreach (['note', 'sid'] as $name) {
    $clearData[$name] = intval($_POST[$name]);
}

require("../../db_config.php");
	try {
		$db = new PDO($dsn, $username, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$SQL = "UPDATE notes SET note=? WHERE sid=? ";
		$st = $db->prepare($SQL);
		$res = $st->execute(array($clearData['note'], $clearData['sid']));
			
			if($st->rowCount()==0) {
				$_SESSION['mess'] = "modification échouée, veuillez réessayer";
			} else {
				$_SESSION['mess'] = "modification de la note réussie";
			}
		
		$db=null;
	} catch (\PDOException $e) {
		http_response_code(500);
		echo "Erreur de serveur: '$e'";
		exit();
	}
	redirect("modif_note.php");
?>