<?php
include("../inc/inc.php");
$id = $_GET['id'];
$level = $_GET['level'];

if ($level == 1){
	$query = $dbh->prepare("DELETE FROM workplacesfirst WHERE id = ?");
	$query->execute(array($id));
	$query = $dbh->prepare("DELETE FROM workplacessecond WHERE idWorkPlaceFirst = ?");
	$query->execute(array($id));
	$query = $dbh->prepare("DELETE FROM userworkplace WHERE idFirstWorkPlace = ?");
	$query->execute(array($id));
}
else if ($level == 2){
	$query = $dbh->prepare("DELETE FROM workplacessecond WHERE id = ?");
	$query->execute(array($id));
	$query = $dbh->prepare("DELETE FROM userworkplace WHERE idSecondWorkPlace = ?");
	$query->execute(array($id));
}
header("Location: index.php?m=controlPanel");

?>


