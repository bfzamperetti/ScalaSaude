<?php
include("inc/inc.php");
$cpf = $_POST['cpf'];
$crf = $_POST['crf'];
$state = $_POST['state'];
$password = $_POST['password'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];


$query = $dbh->prepare("INSERT INTO user (id, cpf, crf, state, password, name, email, phone, authorized) VALUES (0, ?, ?, ?, ?, ?, ?, ?, 'n');");
$query->execute(array($cpf, $crf, $state, $password, $name, $email, $phone));
?>
<script>
	alert('<?php echo $_str['signUpSuccess']; ?>');
	location.href="index.php";
</script>
