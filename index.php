<?php 
include("inc/inc.php");
if (isset($_SESSION['idUser'])) header("Location: mainPage.php"); 
else if (isset($_COOKIE['cpf']) && isset($_COOKIE['password'])){
	$url = 'login.php';
	//login automático
	$data = array('cpf' => $_COOKIE['cpf'], 'password' => $_COOKIE['password']);

	// use key 'http' even if you send the request to https://...
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data),
		),
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
} 
?>

<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $_str['pageTitle']; ?></title>
		<?php 
		include("inc/standardLibraries.php"); 
		include("inc/functions.php"); 
		?>
	</head>
	<body>
		<?php
			if (!isset($_GET['m']))
				include("initialPage.php");
			else
				include ($_GET['m'].'.php');
		?>
    </script>
	</body>
</html>
