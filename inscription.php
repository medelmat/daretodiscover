<?php
session_start();
$connected= isset($_SESSION['email']) ? true : false;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<title>Inscription</title>
	<style type="text/css">
		section>h2{
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
		<section  id="inscription">
			<?php 
				if (isset($_GET['error']) && $_GET['error'] == 'email_missing') {
				echo '<h2>L\'email doit être remplis !!</h2>';
					}
				if (isset($_GET['error']) && $_GET['error'] == 'email_format') {
				echo '<h2>L\'email n\'est pas valide !!</h2>';
				}
				if (isset($_GET['error']) && $_GET['error'] == 'email_taken') {
				echo '<h2>L\'email est déjà utilisé !!</h2>';
				}
				if (isset($_GET['error']) && $_GET['error'] == 'password_missing') {
				echo '<h2>Le mot de passe doit être remplis !!</h2>';
				}
				if (isset($_GET['error']) && $_GET['error'] == 'password_length') {
				echo '<h2>Le mote de passe doit faire entre 5 et 12 caractères.</h2>';
				}
				if (isset($_GET['error']) && $_GET['error'] == 'password_matching') {
				echo '<h2>Vous avez entré deux mots de passe différents !!</h2>';
				}


				if (isset($_GET['error']) && $_GET['error'] == 'file_type') {
				echo '<h2>Le fichier ne correspond pas aux types de fichier autorisés: JPEG, PNG, GIF, JPG !!</h2>';
						}
				if (isset($_GET['error']) && $_GET['error'] == 'file_size') {
				echo '<h2>Le fichier dépasse la taille maximale autorisée (2Mo)</h2>';
						}
				?>
			<div class="small-resume" class="absolute">
								
				<h1> DARE TO DISCOVER ('^_^')</h1>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>

			</div><div class="form-sign" id="formulaire">
				<form action="libs/inscriptioncheck.php"class="form-horizontal" enctype="multipart/form-data" method="post">
					<label class="control-label" for="username">Nom d'utilisateur</label>
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
      				<label>Photo de profil :</label>
      				<input type="file" name="image">
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