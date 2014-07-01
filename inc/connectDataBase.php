<?php 
$host = "localhost";
$port = "5432";
$dbname = "scalasaude";
$user = "root";
$password = "scala";  
//cria PHP data object, ATTR_PERSISTENT para ter Persistent connections, links that do not close when the execution of your script ends
$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $password, array(
    PDO::ATTR_PERSISTENT => true
));

?>

