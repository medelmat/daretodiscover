<?php 
//include('../includes/config.php');
session_start();
$connected= isset($_SESSION['email']) ? true : false;
if(!$connected){
	header('location: ../connexion.php');
	exit;
}
if(!isset($_GET['id']) || empty($_GET['id'])){
	header('location: ../index.php');
	exit;
}
$getid=(int) $_GET['id'];
include('../includes/config.php');

$checkidq=$bdd->prepare("SELECT id_answer, id_question_fk FROM answer WHERE id_answer=?");
$checkidq->execute(array($getid));
$getid_question=$checkidq->fetch();
//Récuperer id de l'utilisateur

$email=implode($_SESSION);
$q="SELECT id_user from user where email=?";
$req=$bdd->prepare($q);
$req->execute(array($email));

while ($user=$req->fetch()) {
		$idUser=$user['id_user'];
}

if($checkidq->rowCount()==1){
	$checklike=$bdd->prepare("SELECT id_like FROM likes WHERE id_answer_fk=? AND id_user_fk=? ");
	$checklike->execute(array($getid, $idUser));
	if($checklike->rowCount()==1){
		$deletelike=$bdd->prepare("DELETE FROM likes WHERE id_answer_fk=? AND id_user_fk=?");
		$deletelike->execute(array($getid, $idUser));

		//header('location: javascript://history.go(-1)');

		header('location: ../questiondisplay.php?id='.$getid_question['id_question_fk']);
		exit;
	}
	elseif ($checklike->rowCount()==0) {
		$addlike=$bdd->prepare("INSERT INTO likes (date_like, id_answer_fk, id_user_fk) values(:date_like, :id_answer_fk, :id_user_fk)");
		$addlike->execute(array(
			'date_like'=>date('Y-m-d H:i:s'),
			'id_answer_fk'=>$getid,
			'id_user_fk'=>$idUser

		));

		//header('location: javascript://history.go(-1)');
		header('location: ../questiondisplay.php?id='.$getid_question['id_question_fk']);
		exit;
	}
}
?>