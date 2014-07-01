<?php

$req = $_GET['update'];

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
	
	$query = $dbh->prepare("UPDATE patient SET   
								   name = ?, 
								   SUS = ?, 
								   email = ?, 
								   phoneHome = ?, 
								   phoneWork = ?, 
								   phoneCel = ?, 
								   CPF = ?, 
								   RG = ?, 
								   birthDate = ?, 
								   gender = ?, 
								   civilState = ?, 
								   weight = ?, 
								   height = ?, 
								   motherName = ?, 
								   street = ?, 
								   complement = ?, 
								   neighboorhood = ?, 
								   city = ?, 
								   contactName = ?, 
								   contactLevel = ?, 
								   contactPhone = ?, 
								   contactStreet = ?, 
								   contactComplement = ?, 
								   contactNeighboorhood = ?, 
								   contactCity = ?,  
								   state = ?
								   WHERE id = ?");
	if ($query->execute(array($name,$SUS,$email,$phoneHome,$phoneWork,$phoneCel,$CPF,$RG,$birthDate,$gender,$civilState,$weight,$height,$motherName,$street,$complement,$neighboorhood,$city,$contactName,$contactLevel,$contactPhone,$contactStreet,$contactComplement,$contactNeighboorhood,$contactCity,$state,$_SESSION['idPatient']))){			
		echo json_encode(array("success" => "!"));
	}
	else{
		echo json_encode(array("error" => $_str['msgErrorUpdatePatient']));
	}
}

if ($req == 'user'){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$CRF = $_POST['CRF'];
	$state = $_POST['state'];
	
	$query = $dbh->prepare("UPDATE user SET   
								   name = ?, 
								   email = ?, 
								   phone = ?, 
								   CRF = ?, 
								   state = ?
								   WHERE id = ?");
	if ($query->execute(array($name,$email,$phone,$CRF,$state,$_SESSION['idUser']))){			
		echo json_encode(array("success" => "!"));
	}
	else{
		echo json_encode(array("error" => $_str['msgErrorUpdateUser'].' Erro:'.$query->errorCode()));
	}
}
?>
