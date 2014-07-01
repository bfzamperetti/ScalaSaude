<?php
$req = $_GET['retrieve'];

if ($req == 'patient'){
	$sth = $dbh->prepare("SELECT id, name, SUS, CPF FROM patient");
	$sth->execute();
	$result = array();
	while ($res = $sth->fetch(PDO::FETCH_ASSOC)){
		$result[] = $res;
	}	
	echo json_encode($result);
}

if ($req == 'patientForAutocomplete'){
	$sth = $dbh->prepare("SELECT id, name, SUS, CPF FROM patient");
	$sth->execute();
	$result = array();
	while ($res = $sth->fetch(PDO::FETCH_ASSOC)){
		if ($res['CPF'] == '') $res['CPF'] = $_str['lblUnavailable']; 
		if ($res['SUS'] == '') $res['SUS'] = $_str['lblUnavailable']; 
		$result[] = array("id" => $res['id'], "name" => $res['name'], "value" => $res['name'].' CPF:'.$res['CPF'].' SUS:'.$res['SUS']);
	}	
	echo json_encode($result);
}

?>
