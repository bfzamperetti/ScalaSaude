<?php 
include("inc/inc.php"); 
if (!isset($_SESSION['idUser']) || !isset($_COOKIE['cpf']) || !isset($_COOKIE['password'])) header("Location: index.php");
$query = $dbh->prepare("SELECT * FROM user WHERE cpf = ? AND password = ?");
$query->execute(array($_COOKIE['cpf'], $_COOKIE['password']));
if ($query->rowCount() == 0){
	setcookie('cpf', '', 1); //expire cookies
	setcookie('password', '', 1);
	header("Location: index.php");
}

?>
<html>
	<head>
		<meta charset="utf-8">
		<title> Sistema de Sa&uacute;de</title>
		
		<?php 
		include("inc/standardLibraries.php"); 
		include("inc/functions.php"); 
		?>
	</head>
	<body>
		<?php
			if (!isset($_GET['m']))
				include("mainContent.php");
			else
				switch ($_GET['m']){
					case "printCalendar": include ("printCalendar".$_GET['c'].".php"); break;
					case "printLabel": include ("printLabel.php"); break;
					default: 
						if (file_exists($_GET['m'].'.php'))
							include ($_GET['m'].'.php');
						else
							include("mainContent.php"); break;
				}
		?>
	</body>
</html>
