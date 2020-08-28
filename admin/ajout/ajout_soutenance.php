<?php
	include("../../auth/EtreAuthentifie.php");
	$page_title="Formulaire d'ajout nouvelle soutenance";
	include("../../header/header_admin.php");
?>
<?php
if(!isset($_POST['CSRFToken']) || !isset($_POST['sid'])) {
	include("../../token.php");
	include('ajout_soutenance_form.php');
	exit();
} else {
	$token = $_SESSION['token'];
	unset ($_SESSION['token']);
	$token_recu = htmlspecialchars($_POST['CSRFToken']);
	$result = hash_equals($token, $token_recu);
	if(!$result) {
		include("../../token.php");
		include('ajout_soutenance_form.php');
		exit();
	}
}

$error = "";

foreach (['sid', 'tuteur1', 'tuteur2'] as $name) {
    $data[$name] = htmlspecialchars($_POST[$name]);
}

if ($data['tuteur1'] == $data['tuteur2']) {
    $error .='Un tuteur ne peut pas a la fois être tuteur principal et secondaire pou une même soutenance'."\n";
}

if (!empty($error)) {
	include("../../token.php");
    include('ajout_soutenance_form.php');
    exit();
}


foreach (['sid', 'tuteur1', 'tuteur2'] as $name) {
    $clearData[$name] = intval($data[$name]);
}

$clearData['date'] = htmlspecialchars($_POST['date']);
$clearData['salle'] = htmlspecialchars($_POST['salle']);


try {
    $SQL = "INSERT INTO soutenances(sid, tuteur1, tuteur2, date, salle) VALUES (:sid,:tuteur1,:tuteur2,:date,:salle) ";
    $stmt = $db->prepare($SQL);
    $res = $stmt->execute($clearData);
	
	if($stmt->rowCount()==0) {
		?><div class="center" style="font-size:120%;color:green;margin-top:200px;margin-left:30%;background:#e6e6e6;padding:10px 10px 10px 10px;width:40%;">
				<strong>Enregistrement soutenance raté, veuillez réessayer.</strong>
		</div><?php
	} else {
		?>
		<div class="center" style="font-size:120%;color:green;margin-top:200px;margin-left:30%;background:#e6e6e6;padding:10px 10px 10px 10px;width:40%;">
			<strong>Enregistrement d'une nouvelle soutenance réussi.</strong>
		</div>
		<?php
	}
    
	$db=null;
} catch (\PDOException $e) {
    http_response_code(500);
    echo "$e.";
    exit();
}
?>
</body>
</html>