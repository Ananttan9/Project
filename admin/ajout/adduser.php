<?php
	include("../../auth/EtreAuthentifie.php");
	$page_title="Formulaire d'ajout nouvel utilisateur";
	include("../../header/header_admin.php");
?>
<?php
if(!isset($_POST['CSRFToken']) || !isset($_POST['login']) || !isset($_SESSION['token'])) {
	include("../../token.php");
	include('adduser_form.php');
	exit();
} else {
	$token = $_SESSION['token'];
	unset ($_SESSION['token']);
	$token_recu = htmlspecialchars($_POST['CSRFToken']);
	$result = hash_equals($token, $token_recu);
	if(!$result) {
		include("../../token.php");
		include("adduser_form.php");
		exit();
	}
}

$error = "";

foreach (['nom', 'prenom', 'login', 'mdp', 'mdp2', 'role', 'actif'] as $name) {
    $data[$name] = htmlspecialchars($_POST[$name]);
}


$SQL = "SELECT uid FROM users WHERE login=?";
$stmt = $db->prepare($SQL);
$res = $stmt->execute([$data['login']]);

if ($res && $stmt->fetch()) {
    $error .= 'Login déjà utilisé'."\n";
}

if ($data['mdp'] != $data['mdp2']) {
    $error .='Les champs mdp ne correspondent pas entre eux'."\n";
}

if (!empty($error)) {
    include('adduser_form.php');
    exit();
}


foreach (['nom', 'prenom', 'login', 'mdp', 'role'] as $name) {
    $clearData[$name] = htmlspecialchars($data[$name]);
}

$actif = intval($data['actif']);

$passwordFunction =
    function ($s) {
        return password_hash($s, PASSWORD_DEFAULT);
    };

$clearData['mdp'] = $passwordFunction($data['mdp']);

try {
    $SQL = "INSERT INTO users(nom,prenom,login,mdp,role,actif) VALUES (:nom,:prenom,:login,:mdp,:role,$actif)";
    $stmt = $db->prepare($SQL);
    $res = $stmt->execute($clearData);
    $id = $db->lastInsertId();
    $auth->authenticate($clearData['login'], $data['mdp']); 
	
	?>
	<div class="center" style="font-size:120%;color:green;margin-top:200px;margin-left:30%;background:#e6e6e6;padding:10px 10px 10px 10px;width:40%;">
		<strong>Enregistrement d'un nouvel utilisateur réussi.</strong>
	</div>
	<?php
    
	$db=null;
} catch (\PDOException $e) {
    http_response_code(500);
    echo "$e.";
    exit();
}
?>
</body>
</html>