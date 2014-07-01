<?php 
include("../inc/inc.php");
if (!isset($_SESSION['admin'])) {
	unset($_GET['m']);
}
else {
	$query = $dbh->prepare("SELECT * FROM adminuser WHERE user = ? AND password = ?");
	$query->execute(array($_SESSION['admin'], $_SESSION['password']));
	if ($query->rowCount() == 0){
		unset($_GET['m']);
	}
}
?>

<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $_str['lblAdminister']; ?></title>
		<link type="text/css" href="../css/styles.css" rel="stylesheet" />
		<?php include("../inc/functions.php") ?>
	</head>
	<body>
		<?php
		//por default executa a página inicial, senão leva ao endereço salvo em 'm' que mudará segundo o usuario
			if (!isset($_GET['m']))
				include("initialPage.php");
			else
				include ($_GET['m'].'.php');
		?>
    </script>
	</body>
</html>
