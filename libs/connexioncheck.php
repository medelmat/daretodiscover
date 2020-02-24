<?php
include('../includes/config.php');
$email= $_POST['email'];
$password=hash('sha256', $_POST['password']);

$q="SELECT id_user, password FROM user WHERE email=? AND password=?";
$req=$bdd->prepare($q);
$req->execute(array($email, $password));
$results=[];
while ($user=$req->fetch()){
	$results[]=$user;
}
if(count($results)>0){
	session_start();
	$_SESSION['email']=$email;
	header('location: ../dashboard.php');
	exit;
}
else{
	header('location:../connexion.php?error=email_password_false');
	exit;
}
?>