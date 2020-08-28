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
	$tuteur1 = intval($_POST['tuteur1']);
	$tuteur2 = intval($_POST['tuteur2']);
	$date = htmlspecialchars($_POST['date']);
	$salle = htmlspecialchars($_POST['salle']);

	try {
		$db = new PDO($dsn, $username, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$SQL = "UPDATE soutenances SET sid=?, tuteur1=?, tuteur2=?, date=?, salle=? WHERE stid=?";
		$st=$db->prepare($SQL);
		$res=$st->execute(array($sid, $tuteur1, $tuteur2, $date, $salle, $stid));
			
		if($st->rowCount()==0) {
			$_SESSION['mess'] = "Aucun changement effectué.";
		} else {
			$_SESSION['mess'] = "Soutenance n° $stid modifiée avec succès.";
		}
		$db=null;
	}
	catch(PDOException $e) {
		exit("Erreur de connexion ".$e->getMessage());
	}
} else {
	$_SESSION['mess'] = "Une erreur s'est produite pendant la modification.";
}
redirect("modif_soutenances.php");