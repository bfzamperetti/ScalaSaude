<?php
include("../inc/inc.php");

if ($_POST['level'] == 1){
	$name = $_POST['nameWorkPlace'];
	
	$query = $dbh->prepare("INSERT INTO workplacesfirst (id, name) VALUES (0, ?);");
	$query->execute(array($name));
}
else if ($_POST['level'] == 2){
	$name = $_POST['nameWorkPlace'];
	$idFirstLevel = $_POST['firstLevelId'];

	$query = $dbh->prepare("INSERT INTO workplacessecond (id, name, idWorkPlaceFirst) VALUES (0, ?, ?);");
	$query->execute(array($name, $idFirstLevel));
}

header("Location: index.php?m=controlPanel");
?>

