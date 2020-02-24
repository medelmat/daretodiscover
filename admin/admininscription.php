<?php
session_start();
$connected= isset($_SESSION['email']) ? true : false;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../styles/style.css">
	<title>Admin Inscription</title>
</head>
<body>
	<?php
	include('includes/header.php')
	?>
	<main>
		<section  id="inscription">
			<div class="small-resume" class="absolute">
				<h1> DARE TO DISCOVER ('^_^') - Admin</h1>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
			</div><div class="form-sign" id="formulaire">
				<form action="libs/inscriptioncheck.php"class="form-horizontal" method="post">
					<label class="control-label" for="username">Nom d'admin</label>
					<div class="controls">
						<input type="text" id="username" name="username" placeholder="Créer votre nom d'utilisateur" class="input-xlarge">
					</div>
					<label class="control-label" for="email">E-mail</label>
					<div>
						<input type="text" id="email" name="email" placeholder="nom@exemple.com" class="input-xlarge">
					</div>
					<label class="control-label" for="password">Mode de passe</label>
                    <div class="controls">
                    <input type="password" id="password" name="password" placeholder="Créer un mot de passe" class="input-xlarge">
                    </div>
                    <label class="control-label"  for="password_confirm">Mot de passe (Confirm)</label>
      				<div class="controls">
        			<input type="password" id="password_confirm" name="password_confirm" placeholder="Confirmer votre mot de passe" class="input-xlarge">
      				</div>
      				<div class="controls">
        			<button class="btn btn-success" class="btn btn-large">Inscription</button>
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