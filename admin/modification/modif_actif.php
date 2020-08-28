<?php
	require("../../auth/EtreAuthentifie.php");
	$page_title = "Modification du champ actif";
	
		$uid = intval($_POST['uid']);
		$actif = intval($_POST['etat']);
		require("../../db_config.php");
			try {
				$db = new PDO($dsn, $username, $password);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				if($actif == 1) {
					$SQL = "UPDATE users SET actif=0 WHERE uid=? ";
					$st=$db->prepare($SQL);
					$res=$st->execute(array($uid));
					$_SESSION['mess'] = "Utilisateur n° $uid désactivé.";
					$SQL2 = "SELECT sid FROM stages WHERE tuteurP=? ";
					$st2=$db->prepare($SQL2);
					$res=$st2->execute(array($uid));
					if($st2->rowCount()!=0) {
						while($row=$st2->fetch()) {
							$sid = intval($row['sid']);
							$tut = "";
							$SQL3 = "UPDATE stages SET tuteurP=$tut WHERE sid=? ";
							$st3=$db->prepare($SQL3);
							$res=$st3->execute(array($sid));
						}
					}
				} else if($actif == 0) {
					$SQL = "UPDATE users SET actif=1 WHERE uid=? ";
					$st=$db->prepare($SQL);
					$res=$st->execute(array($uid));
					$_SESSION['mess'] = "Utilisateur n° $uid activé.";
				}
				
				if($st->rowCount()==0) {
					?><div class="center" style="font-size:120%; padding-bottom:200px;"><?php echo "Aucun utilisateur trouvé dans la base de donnée.";?></div><?php
				}
				$db=null;
			}
			catch(PDOException $e) {
				exit("Erreur de connexion ".$e->getMessage());
			}
	redirect("../liste/liste_users.php");
?>