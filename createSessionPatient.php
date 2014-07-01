<?php
include("inc/inc.php");
if ($_POST['idSelectedPatient'] != 0){
	$_SESSION['idPatient'] = $_POST['idSelectedPatient'];
	$_SESSION['namePatient'] = $_POST['nameSelectedPatient'];
	echo json_encode(array("success" => "!"));
}
else
	echo json_encode(array("error" => $_str['msgErrorSelectPatient']));
?>
