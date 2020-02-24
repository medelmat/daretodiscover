<?php
session_start();
$connected= isset($_SESSION['email']) ? true : false;
?>
<?php
	include('includes/config.php')
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<title>Dare to discover !</title>
</head>
<body>
	<?php
	include('includes/header.php')
	?>
	<main id="accueil">
		<section class="relative" id="langages">
			<h1>Les langages les plus utilisés</h1>
			<span id="border"></span>
    		<nav id="icones" style="MARGIN-TOP: 30PX;">
            <li id="icon"><a><div class="absolute" id="div-left">
			</div></a></li>
			<li id="icon"><a><div class="absolute" id="div-center">
			</div></a></li>
			<li id="icon"><a><div class="absolute" id="div-right">
			</div></a></li>
    		</nav>
		</section><section class="relative" id="actualitees">
			<h1>Dernières questions publiées</h1>
			<span class="border-w"></span>

			
		</section>
		<section class="relative" id="prochainement">
			<h1>Prochainement</h1>
			<span id="border"></span>
			
		</section>
	</main>
	<?php
	include('includes/footer.php')
	?>

</body>
</html>