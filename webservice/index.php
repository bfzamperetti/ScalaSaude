<?php
session_start();
/* incluir paginas necessarias (nao mudar a ordem) */
include('../inc/connectDataBase.php');
include('../inc/strings.php');
?>
<?php	
if (isset($_GET['retrieve'])) include('retrieve.php');
else if (isset($_GET['create'])) include('create.php');
else if (isset($_GET['update'])) include('update.php');
else echo 'Esta requisição não existe.';
?>	
