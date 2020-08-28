<?php
	require("../../auth/EtreAuthentifie.php");
?>
<?php
if(isset($_POST['gid']) && isset($_POST['CSRFToken'])) {
	$token = $_SESSION['token'];
	unset ($_SESSION['token']);
	$token_recu = $_POST['CSRFToken'];
	if(!hash_equals($token, $token_recu)) {
		exit();
	}
	$tokenHash = bin2hex(random_bytes(27));
	$gid = intval($_POST['gid']);
	
	try {
		$db = new PDO($dsn, $username, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$SQL = "UPDATE gestionnaires SET token=? WHERE gid=?";
		$st=$db->prepare($SQL);
		$res=$st->execute(array($tokenHash, $gid));
			
		if($st->rowCount()==0) {
			$_SESSION['mess'] = "La modification a echouée.";
		} else {
			$_SESSION['mess'] = "Token du gestionnaire $gid modifié.";
			$_SESSION['mess2'] = "Le nouveau token est: $tokenHash";
		}
		$db=null;
	}
	catch(PDOException $e) {
		exit("Erreur de connexion ".$e->getMessage());
	}
}
redirect("modif_token.php");