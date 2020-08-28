<!DOCTYPE html>
<html>
	<head>
		<title>
			<?php echo $page_title; ?>
		</title>
		<meta charset="utf-8" />
		<meta name="viewport">
		<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="icon" href="../image/favicon.ico" />
		<link rel="stylesheet" href="<?php echo $pathFor['style']; ?>">
	</head>
	<body>
		<header>
			<script>
				$(function(){
					$("#mod").on("click", function (){
						$("#myModal").modal('show')
					});
				});
				
				function Function_password() {
					var x = document.getElementById("password_id");
					if (x.type === "password") {
						x.type = "text";
					} else {
						x.type = "password";
					}
				}
				
				$(document).ready(function() {
					$("#view_button").bind("mousedown touchstart", function() {
						$("#password").attr("type", "text");
					}), $("#view_button").bind("mouseup touchend", function() {
						$("#password").attr("type", "password");
					})
				});
				
			</script>
				<nav class="container-fluid_2 navbar navbar-default">
					<h1 class="center" style="margin-top:4px; margin-right:5%; font-size: 250%;">LOGISTAGE</h1>
				</nav>
		</header>
