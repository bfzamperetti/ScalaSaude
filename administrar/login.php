<?php
session_start();
include("../inc/inc.php");

$user = $_POST['user'];
$password = $_POST['password'];

$query = $dbh->prepare("SELECT * FROM adminuser WHERE user = ? AND password = ?");
$query->execute(array($user, $password));
if ($res = $query->fetch()){
	$_SESSION['admin'] = $res['user'];
	$_SESSION['password'] = $res['password'];
	header("Location: index.php?m=controlPanel");
	echo "<script>alert('".$_str['userUnauthorizedMessage']."'); location.href='index.php';</script>";		
} 
else {
	echo "<script>alert('".$_str['lblIncorrectData']."'); location.href='index.php';</script>";
}
?>
