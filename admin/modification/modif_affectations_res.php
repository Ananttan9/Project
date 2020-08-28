<?php
	require("../../auth/EtreAuthentifie.php");
?>
<?php 
if(isset($_POST['sid']) && isset($_POST['uid']) && isset($_POST['CSRFToken'])) {
	$token = $_SESSION['token'];
	unset ($_SESSION['token']);
	$token_recu = $_POST['CSRFToken'];
	if(!hash_equals($token, $token_recu)) {
		exit();
	}
	$uid = intval($_POST['uid']);
	$sid = intval($_POST['sid']);

	try {
		$db = new PDO($dsn, $username, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$SQL = "UPDATE stages SET tuteurP=? WHERE sid=?";
		$st=$db->prepare($SQL);
		$res=$st->execute(array($uid,$sid));
			
		if($st->rowCount()==0) {
			$_SESSION['mess'] = "L'affectation a echouée.";
		} else {
			$_SESSION['mess'] = "Affectation du tuteur $uid au stage $sid réussie.";
		}
		$db=null;
	}
	catch(PDOException $e) {
		exit("Erreur de connexion ".$e->getMessage());
	}
} else {
	$_SESSION['mess'] = "Une erreur s'est produite pendant la modification.";
}
redirect("modif_affectations.php");
?>