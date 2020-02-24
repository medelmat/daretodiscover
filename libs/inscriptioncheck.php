 <?php
include('../includes/config.php');
if(!isset($_POST['email'])){
	header('location:../inscription.php?error=email_missing');
	exit;
}
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	header('location:../inscription.php?error=email_format');
	exit;
}
$q="SELECT id_user FROM user WHERE email = ?";
$req=$bdd->prepare($q);
$req->execute(array($_POST['email']));
$answers=[];
while($user = $req->fetch()){
	$answers[]=$user;
}
if (count($answers)!=0){
	header('location:../inscription.php?error=email_taken');
	exit;
}
if(!isset($_POST['password'])){
	header('location:../inscription.php?error=password_missing');
	exit;
}
if(strlen($_POST['password'])<5 || strlen($_POST['password'])>12){
	header('location:../inscription.php?error=password_length');
	exit;
}
if($_POST['password']!=$_POST['password_confirm']){
	header('location:../inscription.php?error=password_matching');
	exit;
}
// Déterminer un chemin pour l'image
    $image_name='profil-'.date('Y-m-d-H-i-s');
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
	header('location: ../inscription.php?error=file_type');
	exit;
}

// Vérification de la taille du fichier

$maxsize= 2097152; // 2Mo 2*1024*1024

	if(($_FILES['image']['size']>$maxsize)){
		header('location: ../inscription.php?error=file_size');
		exit;
	}
include ('../includes/config.php');
$q="INSERT INTO user(email, password, username, user_image) VALUES(:email, :password, :username, :user_image)";
	$req=$bdd->prepare($q);
	$req->execute(array(
		'email' => htmlspecialchars($_POST['email']),
		'password' => hash('sha256', $_POST['password']),
		'username' => htmlspecialchars($_POST['username']),
		'user_image'=>$chemin_image
	));
	header('location: ../connexion.php');
	exit;
?>
