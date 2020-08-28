<?php
	include("../../auth/EtreAuthentifie.php");
	$page_title="Formulaire d'ajout nouveau gestionnaire";
	include("../../header/header_admin.php");
?>
<?php
if(!isset($_POST['token']) || !isset($_POST['tokenG'])) {
	include("../../token.php");
	include('ajout_gestionnaire_form.php');
	exit();
} else {
	$token = $_SESSION['token'];
	unset ($_SESSION['token']);
	$token_recu = htmlspecialchars($_POST['token']);
	$result = hash_equals($token, $token_recu);
	if(!$result) {
		include("../../token.php");
		include("ajout_gestionnaire_form.php");
		exit();
	}
}

foreach (['nom', 'prenom', 'email', 'tokenG'] as $name) {
    $data[$name] = htmlspecialchars($_POST[$name]);
}

$tokenG = htmlspecialchars($_POST['tokenG']);

try {
    $SQL = "INSERT INTO gestionnaires(nom, prenom, email, token) VALUES (:nom,:prenom,:email,:tokenG) ";
    $stmt = $db->prepare($SQL);
    $res = $stmt->execute($data);
	
	if($stmt->rowCount()==0) {
		?><div class="center" style="font-size:120%;color:green;margin-top:200px;margin-left:30%;background:#e6e6e6;padding:10px 10px 10px 10px;width:40%;">
				<strong>Enregistrement gestionnaire raté, veuillez réessayer.</strong>
		</div><?php
	} else {
		?>
		<div class="center" style="font-size:120%;color:green;margin-top:200px;margin-left:20%;background:#e6e6e6;padding:10px 10px 10px 10px;width:700px;">
			<strong>Enregistrement d'un nouveau gestionnaire réussi.</br>
					Votre token est : <p style="color:green;"><?php echo $tokenG; ?></p></br>
					Utilisez le pour avoir acces à la liste des notes.
			</strong>
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