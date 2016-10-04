<?php
/**
	Desarrollado por J.Carlos Gonzalez Torrijos; email:lec3578@gmail.com
	Sep.2016
**/
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "labotario_de_fabricacion";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Comprobamos si ya hay socios que finalicen en 5 dias
$sql = "SELECT nombre, email FROM Socios WHERE fecha_fin = '" . $_GET["fecha"] ."'";

$result = $conn->query($sql);

//Comprobamos si ya hay socios que finalicen justo hoy
$sql2 = "SELECT nombre, email FROM Socios WHERE fecha_fin = '" . $_GET["fecha2"] ."'";

$result2 = $conn->query($sql2);

$rows = array();
while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}
$_SESSION["Resultado"] = json_encode($rows);

$rows2 = array();
while($r = mysqli_fetch_assoc($result2)) {
    $rows2[] = $r;
}
$_SESSION["Resultado2"] = json_encode($rows2);

//header('Location: /control/cron_email.php');

//avisamos si hay resultado o no
	if ($result->num_rows > 0 || $result2->num_rows > 0) 	
		
		header('Location: /control/cron_email.php?hay=1'); 
		
	else {
		
	header('Location: /control/cron_email.php?hay=0'); 
	
	}


?>
