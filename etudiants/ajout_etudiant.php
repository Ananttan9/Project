<?php
	include("../auth/EtreInvite.php");
	$page_title="Formulaire inscription nouvel etudiant";
	include("../header/header_index.php");
?>
<?php
$error = "";

if(!isset($_POST['CSRFToken']) || !isset($_SESSION['token'])) {
	include("../token.php");
	include('ajout_etudiant_form.php');
	exit();
} else {
	$token = $_SESSION['token'];
	unset ($_SESSION['token']);
	$token_recu = htmlspecialchars($_POST['CSRFToken']);
	$result = hash_equals($token, $token_recu);
	if(!$result) {
		exit();
	}
}


foreach (['nom', 'prenom', 'email', 'tel', 'titre', 'description', 'nomE', 'tuteurE', 'emailE', 'dateD', 'dateF'] as $name) {
    if (empty($_POST[$name])) {
        $error .= "La valeur du champs '$name' ne doit pas être vide";
    } else {
        $data[$name] = htmlspecialchars($_POST[$name]);
    }
}


$SQL = "SELECT eid FROM etudiants WHERE nom=? AND prenom=?";
$stmt = $db->prepare($SQL);
$res = $stmt->execute(array($data['nom'], $data['prenom']));

if ($res && $stmt->fetch()) {
    $error .= 'Vous êtes déjà enregistré'."\n";
}


if (!empty($error)) {
    include('ajout_etudiant_form.php');
    exit();
}


foreach (['nom', 'prenom', 'email', 'tel'] as $name) {
    $clearData[$name] = htmlspecialchars($data[$name]);
}

foreach (['titre', 'description', 'nomE', 'tuteurE', 'emailE', 'dateD', 'dateF'] as $name) {
    $clearData2[$name] = htmlspecialchars($data[$name]);
}



try {
    $SQL = "INSERT INTO etudiants(nom,prenom,email,tel) VALUES (:nom,:prenom,:email,:tel)";
    $stmt = $db->prepare($SQL);
    $res = $stmt->execute($clearData);
	
	$SQL = "SELECT eid FROM etudiants WHERE nom=? AND prenom=?";
    $st = $db->prepare($SQL);
    $res = $st->execute(array($clearData['nom'], $clearData['prenom']));
	$row = $st->fetch();
	$eid = intval($row['eid']);
    
	$SQL = "INSERT INTO stages(eid,titre,description,entreprise,tuteurE,emailTE,dateDebut,dateFin) VALUES ($eid,:titre,:description,:nomE,:tuteurE,:emailE,:dateD,:dateF)";
    $st = $db->prepare($SQL);
    $res = $st->execute($clearData2);
	
	if($st->rowCount()==0) {
		?>
		<div class="center" style="font-size:110%; margin-top:100px; margin-bottom:600px;">
			<strong>Il y a eu une erreur dans votre enregistrement, veuillez réessayer.</strong></br>
			<div style="font-size:25px;"><a href="ajout_etudiant.php"><input type="button" value="Réessayer"></a></div>
			</br></br></br>
		</div><?php
	} else {
		?>
		<div class="center" style="font-size:110%; margin-top:100px; margin-bottom:600px; margin-left:20%; width:60%;">
			<strong>Les informations ont bien été enregistrées. Votre numéro de dossier est le : <strong style="color:blue;"><?php echo $eid; ?></strong></strong></br>
			<strong>Vous pourrez utiliser ce numéro pour vous informer via le site, de vos tuteurs pour la soutenance, la date de votre soutenance, ainsi que de votre note final. </strong>
			</br></br></br>
			<div style="font-size:20px;"><a href="<?= $pathFor['logout'] ?>"><input type="button" value="Retourner à la page d'acceuil"></a></div>
		</div>
		<?php
	}
    $db = null;
} catch (\PDOException $e) {
    http_response_code(500);
    echo "Erreur de serveur: '$e'";
    exit();
}
?>

<?php include("../footer.php"); ?>
