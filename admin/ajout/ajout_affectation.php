<?php
	include("../../auth/EtreAuthentifie.php");
	$page_title="Formulaire d'ajout nouvelle affectation de tuteur à un stage";
	include("../../header/header_admin.php");
?>
<?php
if(!isset($_POST['CSRFToken']) || !isset($_POST['uid'])) {
	include("../../token.php");
	include('ajout_affectation_form.php');
	exit();
} else {
	$token = $_SESSION['token'];
	unset ($_SESSION['token']);
	$token_recu = htmlspecialchars($_POST['CSRFToken']);
	$result = hash_equals($token, $token_recu);
	if(!$result) {
		include("../../token.php");
		include('ajout_affectation_form.php');
		exit();
	}
}

$uid = intval($_POST['uid']);
$sid = intval($_POST['sid']);
try {
    $SQL = "UPDATE stages SET tuteurP=?
			WHERE sid=?";
    $stmt = $db->prepare($SQL);
    $res = $stmt->execute(array($uid, $sid));
	
	if($stmt->rowCount()==0) {
		?><div class="center" style="font-size:120%;color:red;margin-top:200px;margin-left:30%;background:#e6e6e6;padding:10px 10px 10px 10px;width:40%;">
			<strong>Affectation echouée, veuillez réesayer.</strong>
		</div><?php
	} else {
		?>
		<div class="center" style="font-size:120%;color:green;margin-top:200px;margin-left:30%;background:#e6e6e6;padding:10px 10px 10px 10px;width:40%;">
			<strong>Affectation d'un tuteur pédagogique au stage réussi.</strong>
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