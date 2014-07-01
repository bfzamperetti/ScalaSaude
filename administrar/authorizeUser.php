<?php
include('../inc/inc.php');

$idUser = $_GET['id'];
$resp = $_GET['r'];

$query = $dbh->prepare("UPDATE user SET authorized = ? WHERE id = ?;");
$query->execute(array($resp, $idUser));

header("Location: index.php?m=controlPanel");
?>
