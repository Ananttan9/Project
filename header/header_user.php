
<!DOCTYPE html>
<html>
	<head>
		<title>
			<?php echo $page_title; ?>
		</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<link rel="icon" href="<?php echo $pathFor['favicon'] ?>"/>
		<link rel="stylesheet" href="<?php echo $pathFor['style'] ?>"/>
	</head>
	
	<body>
		<div id="wrapper">
			<div class="overlay"></div>
			
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand" style="font-size: 180%;"><a href="#">Menu</a></li>
                <li><a href="<?php echo $pathFor['user'] ?>">Accueil</a></li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Liste <span style="font-size:80%; text-align:right;" class="glyphicon glyphicon-menu-down"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo $pathFor['root'] ?>/user/liste/liste_soutenances_tuteur.php">liste des soutenances</a></li>
						<li><a href="<?php echo $pathFor['root'] ?>/user/liste/liste_etudiants.php">liste des etudiants</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Ajouter <span style="font-size:80%; text-align:right;" class="glyphicon glyphicon-menu-down"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo $pathFor['root'] ?>/user/ajout/ajout_note_com.php">ajouter note/commentaire</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Modification <span style="font-size:80%; text-align:right;" class="glyphicon glyphicon-menu-down"></span></a>
					<ul class="dropdown-menu">
						<li class="dropdown"><a href="<?php echo $pathFor['root'] ?>/user/modification/modif_note.php">modifier une note</a></li>
						<li><a href="<?php echo $pathFor['root'] ?>/user/modification/modif_com.php">modifier un commentaire</a></li>
						<li><a href="<?php echo $pathFor['root'] ?>/user/modification/modif_mdp.php">modifier son mot de passe</a></li>
					</ul>
				</li>
				<div class="separator"></div>
				<li style="border:none;"><a href="#" class="deco" id="mod" >Déconnexion <span style="color:#a31f27; margin-left:8px; font-size:120%;" class="glyphicon glyphicon-off"></span></a></li>
            </ul>
        </nav>
        
		<div id="page-content-wrapper">
			<nav class="navbar navbar-inverse" style="height:50px; background:#1a1a1a;"></nav>
			<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
				<span class="hamb-top"></span>
				<span class="hamb-middle"></span>
				<span class="hamb-bottom"></span>
				<span style="margin-left:35px; font-size:140%;">Menu</span>
			</button>
		</div>
		
		<div id="main_menu" style="font-size:120%;">
		<nav class="container-fluid navbar navbar-default navbar-fixed-top">
			<div class="navbar-header" style="margin-top:1%; margin-left: 4%; margin-right: 10%;">
				<a class="navbar-brand" href="<?php echo $pathFor['user'] ?>">LOGISTAGE</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="<?php echo $pathFor['user'] ?>">Accueil</a></li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Liste <span style="font-size:80%; text-align:right;" class="glyphicon glyphicon-menu-down"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo $pathFor['root'] ?>/user/liste/liste_soutenances_tuteur.php">liste des soutenances</a></li>
						<li><a href="<?php echo $pathFor['root'] ?>/user/liste/liste_etudiants.php">liste des etudiants</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Ajouter <span style="font-size:80%; text-align:right;" class="glyphicon glyphicon-menu-down"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo $pathFor['root'] ?>/user/ajout/ajout_note_com.php">ajouter note/commentaire</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Modification <span style="font-size:80%; text-align:right;" class="glyphicon glyphicon-menu-down"></span></a>
					<ul class="dropdown-menu">
						<li class="dropdown"><a href="<?php echo $pathFor['root'] ?>/user/modification/modif_note.php">modifier une note</a></li>
						<li><a href="<?php echo $pathFor['root'] ?>/user/modification/modif_com.php">modifier un commentaire</a></li>
						<li><a href="<?php echo $pathFor['root'] ?>/user/modification/modif_mdp.php">modifier son mot de passe</a></li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li style="border:none;"><a id="mod" data-toggle="modal" href="#myModal" class="deco">Déconnexion <span style="color:#a31f27; margin-left:8px; font-size:120%;" class="glyphicon glyphicon-off"></span></a></li>
			</ul>
		</nav>
		</div>
		
		<header>
			</br></br>
			<script>
				$(function(){
					$("#mod").on("click", function (){
						$("#myModal").modal('show')
					});
				});
				
				window.onscroll = function() {myFunction()};

				function myFunction() {
					if (document.body.scrollTop > 350 || document.documentElement.scrollTop > 350) {
						document.getElementById("myImg").className = "slideUp";
					}
				}
				
				$(document).ready(function(){
					var scrollTop = 0;
					$(window).scroll(function(){
						scrollTop = $(window).scrollTop();
						$('.counter').html(scrollTop);
						if (scrollTop >= 100) {
							$('.container-fluid').addClass('scrolled-nav');
						} else if (scrollTop < 100) {
							$('.container-fluid').removeClass('scrolled-nav');
						} 
					}); 
				});
				
				$(document).ready(function () {
					var trigger = $('.hamburger'),
					overlay = $('.overlay'),
					isClosed = false;

					trigger.click(function () {
						hamburger_cross();      
					});

					function hamburger_cross() {
						if (isClosed == true) {          
							overlay.hide();
							trigger.removeClass('is-open');
							trigger.addClass('is-closed');
							isClosed = false;
						} else {   
							overlay.show();
							trigger.removeClass('is-closed');
							trigger.addClass('is-open');
							isClosed = true;
						}
					}
  
					$('[data-toggle="offcanvas"]').click(function () {
					$('#wrapper').toggleClass('toggled');
					});  
				});
			</script>
		</header>
		
		<section>
		<?php
			if((isset($_SESSION['nom'])) && (isset($_SESSION['prenom']))) {
				?><p class="right-custom">Bienvenue <?php echo htmlspecialchars($_SESSION['prenom']);?>  <?php echo htmlspecialchars($_SESSION['nom']);?></p><?php
			} else {
				echo "<br>";
			}
			?>
		</br>
		<div id="myModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title" style="color:black; font-size:130%;">Confirmation</h4>
					</div>
					<div class="modal-body">
						<p style="color:black;">Voulez-vous vraiment vous déconnecter ?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
						<a href="<?= $pathFor['logout'] ?>"><input type="button" class="btn btn-primary" value="Confirmer"></a>
					</div>
				</div> 
			</div>
		</div> 