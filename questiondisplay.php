<?php
session_start();
$connected= isset($_SESSION['email']) ? true : false;
if(!isset($_GET['id']) || empty($_GET['id'])){
	header('location: index.php');
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<title>Publier votre question</title>
</head>
<body>
	<?php
	include('includes/header.php')
	?>
	<main>
		<section id="inscription" class="post">
			<?php
			include('includes/config.php');
			$getid=(int) $_GET['id'];
			$checkidq=$bdd->prepare("SELECT id_question FROM question WHERE id_question=?");
			$checkidq->execute(array($getid));
			if($checkidq->rowCount()!=1){
				echo '<div style="text-align:center;
				min-height: 250px;
				margin-top:100px;
				"><h1 style="background-color:white"> Cette question n\'existe pas !</h1><input style="padding:5px 15px; 
   				background-color:rgba(87,201,114, 0.7); 
    			border:0 none;
    			cursor:pointer;
    			-webkit-border-radius: 5px;
    			border-radius: 5px;
    			font-size: 15px;
    			color:white;"type="button" value="<= Page précédente" onclick="javascript:history.back()"></div>';
			}

			?>
			<div class="display">
				<div class="user" style="background-color: white">
				<?php
				$getid=(int) $_GET['id'];
				$req=$bdd->query("SELECT username, user_image FROM user WHERE id_user=(SELECT id_user_fk FROM question WHERE id_question=$getid)");
				while($user=$req->fetch()){
				echo '<div class="image_profil" style="background-image:url(p'.$user['user_image'].')"></div>';
				echo '<p style="font-size:16px;">'.$user['username'].'</p>';

				}
				?>
				</div>
				<div class="user-post">
				<?php
				$getid=(int) $_GET['id'];
				$q=$bdd->prepare("SELECT * FROM question WHERE id_question=?");
				$q->execute(array($getid));
				while($question=$q->fetch()){
					echo '<h2 class="title_question">'.$question['title_question'].'</h2>';
					$classid=(int) $question['id_class_fk'];
					$req1=$bdd->query("SELECT name_class FROM class WHERE id_class=$classid");
					while($class=$req1->fetch()){
						echo '<div class="details_post"><p class="class_post">Catégorie : '.$class['name_class'].'</p>';
					}
					$date_post=explode(" ", $question['date_question']);
					echo '<p class="date_post">Publié le: '.$date_post[0].'</p></div>';
					echo '<p class="body_post">'.$question['body_question'].'</p>';
					echo '<img src="p/'.$question['image_question'].'">';
				}
				?>
				</div>

			</div>
			<?php
			$getid=(int) $_GET['id'];
			$getanswers=$bdd->prepare("SELECT * from answer WHERE id_question_fk=?");
			$getanswers->execute(array($getid));
			while($answer=$getanswers->fetch()){
			echo '<div class="display">
			<div class="user">';
			$iduser=$answer['id_user_fk'];
			$user_answer=$bdd->prepare("SELECT username, user_image FROM user WHERE id_user=?");
			$user_answer->execute(array($iduser));
			while($user1=$user_answer->fetch()){
			echo '<div class="image_profil" style="background-image:url(p'.$user1['user_image'].')"></div>';
			echo '<p style="font-size:16px;">'.$user1['username'].'</p></div>';

			}
			$likescount=$bdd->prepare("SELECT count(*) FROM likes WHERE id_answer_fk=?");
			$likescount->execute(array($answer['id_answer']));
			$result_likescount=$likescount->fetch();
			echo '<div class="user-post">
			<p style="margin-top:0;"class="date_post">Publié le: '.$answer['date_answer'].'</p>
			<p class="body_post">'.$answer['answer'].'</p>
			<img src="p/'.$answer['image_answer'].'">
			<a class="likebutton" href="libs/likeaction.php?id='.$answer['id_answer'].'">J\'aime ('.$result_likescount['0'].')</a></div>

			</div>';
			}
			?>
			<div class="display">
				<div class="user">
				<?php
				if(!$connected){
				echo '<div class="image_profil" style="background-image:url(p/images/inconnu.png)"></div>';
				echo '<p style="font-size:16px;">Utilisateur non connecté</p>';

				}
				else{
				$email=implode($_SESSION);
				$user_data=$bdd->prepare("SELECT username, user_image FROM user WHERE email=?");
				$user_data->execute(array($email));
				$user_infos=$user_data->fetch();
				echo '<div class="image_profil" style="background-image:url(p/'.$user_infos['user_image'].')"></div>';
				echo '<p style="font-size:16px;">'.$user_infos['username'].'</p>';
				}

				?>
				</div>
				<div class="user-post">
					<?php

					echo'<form class="reponsepost" action="libs/answerstore.php?id='.$getid.'" method="post" enctype="multipart/form-data">';

					if (isset($_GET['error']) && $_GET['error'] == 'answerbody_missing') {
						echo '<h2>N\'oubliez pas de remplir le contenu !</h2>';
						}
					if (isset($_GET['error']) && $_GET['error'] == 'file_type') {
						echo '<h2>Le fichier ne correspond pas aux types de fichier autorisés: JPEG, PNG, GIF, JPG !!</h2>';
						}
					if (isset($_GET['error']) && $_GET['error'] == 'file_size') {
						echo '<h2>Le fichier dépasse la taille maximale autorisée (2Mo)</h2>';
						}
					?>
					<textarea type="text" name="answerbody" class="answer_body" placeholder="Rédiger votre réponse..."></textarea>
					<br>
    				<div class="bouton_post_comment" style="display: inline-block;width: 100%;">
					<label style="display: inline-block;">Ajouter une image :</label>
					
					<input type="file" name="image" style="display: inline-block;">
					<button style="float: right; width: 30%;">Publier</button>
    				</div>
					</form>
				</div>
				
			</div>
		</section>
	
	</main>
	<?php
	include('includes/footer.php')
	?>
</body>
</html>