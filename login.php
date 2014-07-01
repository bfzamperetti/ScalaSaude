<?php
include("inc/inc.php");

$cpf = $_POST['cpf'];
$password = $_POST['password'];

$query = $dbh->prepare("SELECT * FROM user WHERE cpf = ? AND password = ?");
$query->execute(array($cpf, $password));
if ($res = $query->fetch()){
	if ($res['authorized'] == 'y'){
		$time = (isset($_POST['keepLogged']) ? time()+60*60*24*30 : 0);
		setcookie('cpf', $cpf, $time);
		setcookie('password', $password, $time);
		$_SESSION['idUser'] = $res['id'];
		header("Location: mainPage.php");
	}
	else {
		echo "<script>alert('".$_str['userUnauthorizedMessage']."'); location.href='index.php';</script>";		
	}
} 
else {
	echo "<script>alert('".$_str['lblIncorrectData']."'); location.href='index.php';</script>";
}
?>
