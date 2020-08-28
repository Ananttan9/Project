<?php
include("../auth/EtreInvite.php");
$page_title="Page d'acceuil: Authentification";
include("../header/header_index.php");

$error2 = "";

if(isset($_POST['dossier']) && !empty($_POST['dossier'])) {
	if(is_string($_POST['dossier'])) {
		$_SESSION['dossier'] = htmlspecialchars($_POST['dossier']);
		include("../etudiants/dossier_etudiant.php");
		exit();
	}
}

// Check if it is the first visit
if ((empty($_POST['login']) && empty($_POST['password']))) {
    include('login_form.php');
    exit();
}

$error = "";

foreach (['login', 'password'] as $name) {
    if (empty($_POST[$name])) {
        $error .= "La valeur du champs '$name' ne doit pas être vide";
    }
}

// do the next step if no errors
if (empty($error)) {
    $data['login'] = $_POST['login'];
    $data['password'] = $_POST['password'];
    if (!$auth->existIdentity($data['login'])) {
        $error =  "Utilisateur inexistant";
    }
}

// do the next step if no errors
if (empty($error)) {
    $role = $auth->authenticate($data['login'], $data['password']);
    if (!$role) {
        $error = "Echec de l'authentification";
    }
}

// if errors then stop

if (!empty($error)) {
    include('login_form.php');
    exit();
}



require("../db_config.php");
			try {
				$db = new PDO($dsn, $username, $password);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
				$SQL = "SELECT uid, nom, prenom, role FROM users WHERE login=?";
				$st = $db->prepare($SQL);
				$res=$st->execute(array($data['login']));
				if($st->rowCount()==0) {
					echo "Erreur recuperation identité utilisateur";
				} else {
					$row=$st->fetch();
					if((is_string($row['nom'])) && (is_string($row['prenom']))) {
					$_SESSION['nom'] = htmlspecialchars($row['nom']);
					$_SESSION['prenom'] = htmlspecialchars($row['prenom']);
					}
					if($row['role'] == 'admin') {
						$_SESSION['role'] = 'admin';
						$_SESSION['uid'] = $row['uid'];
						redirect($pathFor['admin']);
						exit();
					} else if($row['role'] == 'user') {
						$_SESSION['role'] = 'user';
						$_SESSION['uid'] = $row['uid'];
						redirect($pathFor['user']);
						exit();
					}
				}
				echo "pas de resultat";
				$db=null;
			}
			catch(PDOException $e) {
				exit("Erreur de connexion ".$e->getMessage());
			}


redirect($pathFor['root']);



