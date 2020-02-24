<?php
session_start();
$connected= isset($_SESSION['email']) ? true : false;

if($connected){
	header('location: index.php');
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<title>Connexion</title>
		<style type="text/css">
		section>div>h2{
			color: #a94442;
			background-color: #f2dede;
			border-color: #ebccd1;
			padding: 15px;
			margin-bottom: 20px;
			border: 1px solid transparent;
			border-radius: 4px;
			text-align: center;
		}
	</style>
</head>
<body>
	<?php
	include('includes/header.php')
	?>
	<main>
		<section class="relative" id="inscription">
			<div class="small-resume" class="absolute">
				<h1> DARE TO DISCOVER ('^_^')</h1>
				<?php 
				if (isset($_GET['error']) && $_GET['error'] == 'email_password_false') {
					echo '<h2>L\'email ou mot de passe sont incorrects !!</h2>';
					}
				?>

			</div><div class="form-sign" id="formulaire">
				<form class="form-horizontal" action="libs/connexioncheck.php" method="post">
					<label class="control-label" for="email">E-mail</label>
					<div>
						<input type="text" id="email" name="email" placeholder="nom@exemple.com" class="input-xlarge">
					</div>
					<label class="control-label" for="password">Mode de passe</label>
                    <div class="controls">
                    <input type="password" id="password" name="password" placeholder="Entrer votre mot de passe" class="input-xlarge">
                    </div>
      				<div class="controls">
        			<button class="btn btn-success" class="btn btn-large">Connexion</button>
      				</div>
				</form>
			</div>
		</section>
	</main>
	<?php
	include('includes/footer.php')
	?>
</body>
</html>