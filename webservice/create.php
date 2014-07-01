<?php

$req = $_GET['create'];

if ($req == 'patient'){
	$name = $_POST['name'];
	$SUS = $_POST['SUS'];
	$email = $_POST['email'];
	$phoneHome = $_POST['phoneHome'];
	$phoneWork = $_POST['phoneWork'];
	$phoneCel = $_POST['phoneCel'];
	$CPF = $_POST['CPF'];
	$RG = $_POST['RG'];
	$birthDate = $_POST['birthDate'];
	$gender = $_POST['gender'];
	$civilState = $_POST['civilState'];
	$weight = $_POST['weight'];
	$height = $_POST['height'];
	$motherName = $_POST['motherName'];
	$street = $_POST['street'];
	$complement = $_POST['complement'];
	$neighboorhood = $_POST['neighboorhood'];
	$city = $_POST['city'];
	$contactName = $_POST['contactName'];
	$contactLevel = $_POST['contactLevel'];
	$contactPhone = $_POST['contactPhone'];
	$contactStreet = $_POST['contactStreet'];
	$contactComplement = $_POST['contactComplement'];
	$contactNeighboorhood = $_POST['contactNeighboorhood'];
	$contactCity = $_POST['contactCity'];
	$state = $_POST['state'];
	
	$query = $dbh->prepare("INSERT INTO patient (id, idUserCreator, name,SUS,email,phoneHome,phoneWork,phoneCel,CPF,RG,birthDate,gender,civilState,weight,height,motherName,street,complement,neighboorhood,city,contactName,contactLevel,contactPhone,contactStreet,contactComplement,contactNeighboorhood,contactCity, state, creationDate)
							VALUES (0, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
	if ($query->execute(array($_SESSION['idUser'], $name,$SUS,$email,$phoneHome,$phoneWork,$phoneCel,$CPF,$RG,$birthDate,$gender,$civilState,$weight,$height,$motherName,$street,$complement,$neighboorhood,$city,$contactName,$contactLevel,$contactPhone,$contactStreet,$contactComplement,$contactNeighboorhood,$contactCity,$state,date("Y-m-d")))){			
		echo json_encode(array("success" => "!"));
	}
	else{
		echo json_encode(array("error" => $_str['msgErrorAddPatient']));
	}
}
?>
