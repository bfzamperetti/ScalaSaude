<?php
	session_start();
	$_SESSION['projectCalendar'][$_POST['index']]['table'] = $_POST['table'];
	$_SESSION['projectCalendar'][$_POST['index']]['name'] = $_POST['name'];
	$_SESSION['projectCalendar'][$_POST['index']]['type'] = $_POST['type'];
	$_SESSION['projectCalendar']['current'] = $_POST['current'];
?>
