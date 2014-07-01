<?php
	session_start();
	setcookie('cpf', '', 1); //expire cookies
	setcookie('crf', '', 1);
	session_destroy();
	header("Location: index.php");
?>
