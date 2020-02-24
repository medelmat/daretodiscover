<?php
include('../includes/config.php');
session_start();
$connected= isset($_SESSION['email']) ? true : false;
if(!isset($_POST['password'])){
	header('location: ../dashboard.php?display=modifypassword&error=actualpassword_missing');
	exit;
}
if(!isset($_POST['newpassword'])){
	header('location: ../dashboard.php?display=modifypassword&error=newpassword_missing');
	exit;
}
if($_POST['newpasswordconfirm']!=$_POST['newpassword']){
	header('location: ../dashboard.php?display=modifypassword&error=newpasswordconfirm_match');
	exit;
}

$actualpassword=hash('sha256', $_POST['password']);
$email=implode($_SESSION);
$q="SELECT id_user FROM user WHERE email=? AND password=?";
$req=$bdd->prepare($q);
$req->execute(array($email, $actualpassword));
while ($user=$req->fetch()){
	$results=$user['id_user'];
}
$q1="SELECT id_user from user where email=?";
$req2=$bdd->prepare($q1);
$req2->execute(array($email));

while ($user1=$req2->fetch()) {
		$idUser=$user1['id_user'];
}

if($results==$idUser){
$newpassword=hash('sha256', $_POST['newpassword']);
$sql="UPDATE user SET password=? WHERE email=?";
$req1=$bdd->prepare($sql);
$req1->execute(array($newpassword, $email));
header('location: ../dashboard.php?display=modifypassword_ok');
exit;
}
else{
	header('location: ../dashboard.php?display=modifypassword&error=actualpassword');
	exit;
}

?>