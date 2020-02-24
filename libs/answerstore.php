<?php
include('../includes/config.php');
session_start();
$connected= isset($_SESSION['email']) ? true : false;


$getid=(int) $_GET['id'];
// Corps de la réponse

if(!isset($_POST['answerbody']) || empty($_POST['answerbody'])){
	header('location: ../questiondisplay.php?error=answerbody_missing&id='.$getid);
	exit;
}

// Déterminer un chemin pour l'image
    $image_name='answer-'.date('Y-m-d-H-i-s');
    $filename=$_FILES['image']['name']; // nom de la base du fichier avec son extention
    $temp_array=explode(".", $filename); // Création de tableau ( 1 parametre: séparateur, 2 parametre: elements)
    $extention= end($temp_array);
    $chemin_image='../uploads/'.$image_name.'.'.$extention;

// déplacer le fichier uploadé vers son emplacement final
    move_uploaded_file($_FILES['image']['tmp_name'], $chemin_image);

// Verificateur du type de fichier

    $acceptable=array(
    	'image/jpeg',
    	'image/jpg',
    	'image/gif',
    	'image/png'
    );
if((!in_array($_FILES['image']['type'], $acceptable)) && (!empty($_FILES['image']['type']))){
	header('location: ../questionpdisplay.php?error=file_type&id='.$getid);
	exit;
}

// Vérification de la taille du fichier

$maxsize= 2097152; // 2Mo 2*1024*1024

	if(($_FILES['image']['size']>$maxsize)){
		header('location: ../questiondisplay.php?error=file_size&id='.$getid);
		exit;
	}

$email=implode($_SESSION);
$q="SELECT id_user from user where email=?";
$req=$bdd->prepare($q);
$req->execute(array($email));

while ($user=$req->fetch()) {
		$idUser=$user['id_user'];
}


$q="INSERT INTO answer(answer, image_answer, date_answer, id_user_fk, id_question_fk) VALUES(:answer, :image_answer, :date_answer, :id_user_fk, :id_question_fk)";
$req=$bdd->prepare($q);
$req->execute(array(
		'answer'=>htmlspecialchars($_POST['answerbody']),
		'image_answer'=>$chemin_image,
		'date_answer'=>date('Y-m-d H:i:s'),
		'id_user_fk'=>$idUser,
		'id_question_fk'=>$getid

));
	header('location: ../questiondisplay.php?id='.$getid);
	exit;

?>