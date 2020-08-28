<?php
	require("../../auth/EtreAuthentifie.php");
	$page_title="Modification du mot de passe";
	include("../../header/header_user.php");
	?>
		<?php
		$error1 = "";
		$error2 = "";
		require("../../db_config.php");
			if(!isset($_SESSION['token']) || !isset($_POST['CSRFToken'])) {
				include("../../token.php");
				include('modif_mdp_form.php');
				exit();
			} else {
				$token = $_SESSION['token'];
				unset ($_SESSION['token']);
				$token_recu = $_POST['CSRFToken'];
				if(!hash_equals($token, $token_recu)) {
					include("../../token.php");
					include('modif_mdp_form.php');
					exit();
				}
			}
			
			$mdp1 = htmlspecialchars($_POST['new_mdp']);
			$mdp2 = htmlspecialchars($_POST['new2_mdp']);
			if (!hash_equals($mdp1, $mdp2)) {
				$error1 .='Vous avez mal répéter votre nouveau mot de passe'."<br>";
			}
			
			$uid = intval($_SESSION['uid']);
			$old_mdp = htmlspecialchars($_POST['old_mdp']);
			try {
				$db = new PDO($dsn, $username, $password);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$SQL = "SELECT mdp FROM users WHERE uid=?";
				$st=$db->prepare($SQL);
				$res=$st->execute(array($uid));
		
				if($st->rowCount()==0) {
					?><div class="center" style="font-size:120%;color:red;margin-top:200px;margin-left:33%;background:#e6e6e6;padding:10px 10px 10px 10px;width:400px;">
						<p>Il y a eu un problème dans le numéro d'utilisateur.</p>
					</div><?php
				} else {
					while($row=$st->fetch()) {
						if(!password_verify($old_mdp, $row['mdp']))	{
							$error2 .='Le champ "ancien mot de passe" est incorrect'."<br>";
						}
					}
				}
				$db=null;
			}
			catch(PDOException $e) {
				exit("Erreur de connexion ".$e->getMessage());
			}
			
			if (!empty($error)) {
				include('modif_mdp_form.php');
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
					?><div class="center" style="font-size:120%;color:red;margin-top:200px;margin-left:33%;background:#e6e6e6;padding:10px 10px 10px 10px;width:400px;">
						<p>Il y a eu un problème dans le numéro d'utilisateur.</p>
					</div><?php
				} else {
					?><div class="center" style="font-size:120%;color:green;margin-top:200px;margin-left:33%;background:#e6e6e6;padding:10px 10px 10px 10px;width:400px;">
						<p>Le mot de passe a bien été modifié.</p>
					</div><?php
				}
				$db=null;
			}
			catch(PDOException $e) {
				exit("Erreur de connexion ".$e->getMessage());
			}
		
		?>
	<?php
	include("../../footer.php");
	?>