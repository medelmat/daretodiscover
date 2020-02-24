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
	<title>Votre Tableau de bord</title>
</head>
<body>
	<?php
	include('includes/header.php')
	?>
	<main>
		<section id="dashboard">
		

		<div class="menu-user">
			<ul id="nav-dashboard">
				<li><a href="dashboard.php?display=mesquestions">Mes questions</a></li>
				<li><a href="dashboard.php?display=mesreponses">Mes réponses</a></li>
				<li><a href="questionpost.php">Poster une question</a></li>
				<li><a href="dashboard.php?display=modifypassword">Changer mon mot de passe</a></li>
				<li><a href="#questions">Supprimer mon compte</a></li>
			</ul>
		</div>
		<div class="dashboard-display">
			<?php
			if (isset($_GET['display']) && $_GET['display'] == 'mesquestions'){
			echo '<h2>Mes questions</h2>
			<table>
				<tr>
					<th>Titre</th>
					<th>Date de publication</th>
				</tr>';
			
			include('includes/config.php');
			$email=implode($_SESSION);
			$q="SELECT id_user from user where email=?";
			$req=$bdd->prepare($q);
			$req->execute(array($email));

			while ($user=$req->fetch()) {
				$idUser=$user['id_user'];
			}
			$sql="SELECT id_question, title_question, date_question from question where id_user_fk=?";
			$req1=$bdd->prepare($sql);
			$req1->execute(array($idUser));
			while($question=$req1->fetch()){
				echo '<tr>
				<td><a style="color:black;" title="Appuyer pour voir la question" href="questiondisplay.php?id='.$question['id_question'].'">'.$question['title_question'].'</a></td>
				<td>'.$question['date_question'].'</td>
				</tr>';

			}
			
			echo '</table>';
		}
		if (isset($_GET['display']) && $_GET['display'] == 'mesreponses'){
			echo '<h2>Mes réponses</h2>
			<table>
				<tr>
					<th>Réponse</th>
					<th>Question</th>
					<th>Date</th>
				</tr>';
		include('includes/config.php');		
		$email=implode($_SESSION);
		$q="SELECT id_user from user where email=?";
		$req=$bdd->prepare($q);
		$req->execute(array($email));
		while ($user=$req->fetch()) {
				$idUser=$user['id_user'];
		}
		$sql="SELECT answer, date_answer, title_question, id_question FROM answer, question WHERE answer.id_user_fk=$idUser AND answer.id_question_fk=question.id_question";
		$req1=$bdd->query("$sql");
		while($reponse=$req1->fetch()){
			echo '<tr>
			<td><a style="color:black;" title="Appuyer pour voir la réponse" href="questiondisplay.php?id='.$reponse['id_question'].'">'.$reponse['answer'].'</a></td>
			<td><a style="color:black;" title="Appuyer pour voir la question" href="questiondisplay.php?id='.$reponse['id_question'].'">'.$reponse['title_question'].'</a></td>
			<td>'.$reponse['date_answer'].'</td>
			</tr>';
		}
			echo '</table>';

		}
		if (isset($_GET['display']) && $_GET['display'] == 'modifypassword'){
			if (isset($_GET['error']) && $_GET['error'] == 'actualpassword_missing'){
				echo '<h2 color="white">N\'oubliez pas de saisir votre mot de passe actuel !</h2>';
			}
			if (isset($_GET['error']) && $_GET['error'] == 'newpassword_missing'){
				echo '<h2 color="white">N\'oubliez pas de saisir votre nouveau mot de passe !</h2>';
			}
			if (isset($_GET['error']) && $_GET['error'] == 'newpasswordconfirm_match'){
				echo '<h2 color="white">Les champs nouveau mot de passe/confirmation du nouveau mot de passe ne corrrespondent pas !</h2>';
			}
			if (isset($_GET['error']) && $_GET['error'] == 'actualpassword'){
				echo '<h2 color="white">Votre mot de passe actuel est incorrect !</h2>';

			}

			echo '<div class="modifpwd" id="formulaire">
				<form class="form-horizontal" action="libs/modifypassword.php" method="post">
					<label class="control-label" for="password">Mot de passe actuel</label>
					<div>
						<input type="password" id="password" name="password" placeholder="Entrer mot de passe actuel" class="input-xlarge">
					</div>
					<label class="control-label" for="password">Nouveau mot de passe</label>
                    <div class="controls">
                    <input type="password" id="newpassword" name="newpassword" placeholder="Entrer votre nouveau mot de passe" class="input-xlarge">
                    </div>
                    <label class="control-label" for="password">Confirmer le nouveau mot de passe</label>
                    <div class="controls">
                    <input type="password" id="newpasswordconfirm" name="newpasswordconfirm" placeholder="Entrer votre nouveau mot de passe" class="input-xlarge">
                    </div>
                    <div class="controls">
        			<button class="btn btn-success" class="btn btn-large">Valider</button>
      				</div>';

		}
		if (isset($_GET['display']) && $_GET['display'] == 'modifypassword_ok'){
			echo '<h2 color="white">Votre mot de passe a été modifié avec succès !</h2>';

		}

			?>

		</div>
		</section>
		
	</main>
	<?php
	include('includes/footer.php')
	?>
</body>
</html>
