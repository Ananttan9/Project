<?php
	require("../../auth/EtreAuthentifie.php");
?>
<?php
if(isset($_POST['CSRFToken'])) {
	$token = $_SESSION['token'];
	unset ($_SESSION['token']);
	$token_recu = $_POST['CSRFToken'];
	if(!hash_equals($token, $token_recu)) {
		exit();
	}
	$stid = intval($_POST['stid']);
	$sid = intval($_POST['sid']);
	$note = intval($_POST['new_note']);

	try {
		$db = new PDO($dsn, $username, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$SQL = "UPDATE notes SET note=? WHERE sid=?";
		$st=$db->prepare($SQL);
		$res=$st->execute(array($note, $sid));
			
		if($st->rowCount()==0) {
			$_SESSION['mess2'] = "Aucun changement effectué.";
		} else {
			$_SESSION['mess2'] = "note modifiée avec succès.";
		}
		$db=null;
	}
	catch(PDOException $e) {
		exit("Erreur de connexion ".$e->getMessage());
	}
} else {
	$_SESSION['mess2'] = "Une erreur s'est produite pendant la modification.";
}
redirect("modif_soutenances.php");