<?php 
if (isset($_SESSION['idPatient'])){

	include("contentNav.php"); 

	if (!isset($_GET['s']))
		include("calendars.php");
	else
		if (file_exists($_GET['s'].'.php'))
			include ($_GET['s'].'.php');
		else
			include("calendars.php"); 
		
	include("divsForDialogs.php"); 
}
else 
	include("patientUnselected.php"); 

?>
