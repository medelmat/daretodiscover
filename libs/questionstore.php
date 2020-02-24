<?php
include('../includes/config.php');
session_start();
$connected= isset($_SESSION['email']) ? true : false;
// Categorie

if(!isset($_POST['class']) || empty($_POST['class'])){
	header('location: ../questionpost.php?error=class_missing');
	exit;
}
// Objet de la question

if(!isset($_POST['questiontitle']) || empty($_POST['questiontitle'])){
	header('location: ../questionpost.php?error=questiontitle_missing');
	exit;
}

// Corps de la question

if(!isset($_POST['questionbody']) || empty($_POST['questionbody'])){
	header('location: ../questionpost.php?error=questionbody_missing');
	exit;
}

// Déterminer un chemin pour l'image
    $image_name='question-'.date('Y-m-d-H-i-s');
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
	header('location: ../questionpost.php?error=file_type');
	exit;
}

// Vérification de la taille du fichier

$maxsize= 2097152; // 2Mo 2*1024*1024

	if(($_FILES['image']['size']>$maxsize)){
		header('location: ../questionpost.php?error=file_size');
		exit;
	}

$email=implode($_SESSION);
$idClass=$_POST['class'];
$q="SELECT id_user from user where email=?";
$req=$bdd->prepare($q);
$req->execute(array($email));

while ($user=$req->fetch()) {
		$idUser=$user['id_user'];
}

$q="INSERT INTO question(title_question, body_question, image_question, date_question, id_user_fk, id_class_fk) VALUES(:title_question, :body_question, :image_question, :date_question, :id_user_fk, :id_class_fk)";
$req=$bdd->prepare($q);
$req->execute(array(
		'title_question'=>htmlspecialchars($_POST['questiontitle']),
		'body_question'=>htmlspecialchars($_POST['questionbody']),
		'image_question'=>$chemin_image,
		'date_question'=>date('Y-m-d H:i:s'),
		'id_user_fk'=>$idUser,
		'id_class_fk'=>$idClass 

));
	$sql=$bdd->prepare("SELECT id_question FROM question WHERE image_question=?");
	$sql->execute(array($chemin_image));
	$id_question=$sql->fetch();
	header('location: ../questiondisplay.php?id='.$id_question['0']);
	exit;

?>


















