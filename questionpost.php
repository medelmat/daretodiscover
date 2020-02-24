<?php
session_start();
$connected= isset($_SESSION['email']) ? true : false;

if(!$connected){
	header('location: connexion.php');
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<title>Publier votre question</title>
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
		<section id="inscription" class="post">
			<div >
				<h1 style="color: white; text-align: center;" >Do you need help ? Post your question NOW !</h1>
				<?php
				if (isset($_GET['error']) && $_GET['error'] == 'class_missing') {
							echo '<h2>Sélectionner une catégorie !</h2>';
						}
						if (isset($_GET['error']) && $_GET['error'] == 'questiontitle_missing') {
							echo '<h2>N\'oubliez pas de remplir l\'objet !</h2>';
						}
						if (isset($_GET['error']) && $_GET['error'] == 'questionbody_missing') {
							echo '<h2>N\'oubliez pas de remplir le contenu !</h2>';
						}
						if (isset($_GET['error']) && $_GET['error'] == 'file_type') {
							echo '<h2>Le fichier ne correspond pas aux types de fichier autorisés: JPEG, PNG, GIF, JPG !!</h2>';
						}
						if (isset($_GET['error']) && $_GET['error'] == 'file_size') {
							echo '<h2>Le fichier dépasse la taille maximale autorisée (2Mo)</h2>';
						}
						?>
				
			</div>
			<div>
				<form  class="questionpost" action="libs/questionstore.php" method="post" enctype="multipart/form-data">
					<label>Classer votre question :</label>
					<select name ="class" class="selectclass">
						<?php
						include('includes/config.php');
						$sql = "select id_class, name_class from class"; 
						$rep = $bdd->query("$sql") ; 
						while($data =$rep->fetch()) 
						{ 
						echo '<option value="'.$data['id_class'].'">'.$data['name_class'].'</option>'; 
						}
						$rep->closeCursor();

						?>
					</select>
					<br>
					<br>
					<label>Titre :</label>
					<br>
					<input type="text" name="questiontitle" class="object" placeholder="L'objet de votre question...">
					<br>
					<label>Contenu :</label>
					<br>
					<textarea type="text" name="questionbody" class="body" placeholder="Rédiger votre question..."></textarea> 
					<br>
					<label>Ajouter une image :</label>
					<br>
					<br>
					<input type="file" name="image">
					<br>
					<br>
					<button>Publier</button>
				</form>
			</div>
		</section>
	
	</main>
	<?php
	include('includes/footer.php')
	?>
</body>
</html>