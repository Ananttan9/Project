<?php
	require("../../auth/EtreAuthentifie.php");
?>
<?php
$error = "";
if(isset($_POST['uid']) && isset($_POST['CSRFToken'])) {
	$token = $_SESSION['token'];
	unset ($_SESSION['token']);
	$token_recu = $_POST['CSRFToken'];
	if(!hash_equals($token, $token_recu)) {
		exit();
	}
	$mdp1 = htmlspecialchars($_POST['new_mdp']);
	$mdp2 = htmlspecialchars($_POST['new2_mdp']);
	if (!hash_equals($mdp1, $mdp2)) {
		$error .="Vous avez mal répéter le nouveau mot de passe, réessayez";
	}
	$uid = intval($_POST['uid']);
	if (!empty($error)) {
		$_SESSION['error'] = $error;
		redirect("modif_mdp.php");
		exit();
	}
	$mdp = htmlspecialchars($_POST["new_mdp"]);
	$passwordFunction =
		function ($s) {
			return password_hash($s, PASSWORD_DEFAULT);
		};
	$mdpHash = $passwordFunction($mdp);

	try {
		$db = new PDO($dsn, $username, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$SQL = "UPDATE users SET mdp=? WHERE uid=?";
		$st=$db->prepare($SQL);
		$res=$st->execute(array($mdpHash,$uid));
			
		if($st->rowCount()==0) {
			$_SESSION['mess'] = "La modification a echouée.";
		} else {
			$_SESSION['mess'] = "Mot de passe de l'utilisateur $uid modifié.";
		}
		$db=null;
	}
	catch(PDOException $e) {
		exit("Erreur de connexion ".$e->getMessage());
	}
}
redirect("modif_mdp.php");