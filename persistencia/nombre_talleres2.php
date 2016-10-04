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


$sql = "SELECT nombre FROM Taller";
$result = $conn->query($sql);

$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
		    $rows[] = $r;
		}
		$_SESSION["result"] = json_encode($rows);

header('Location: /interfaz/quitar_socio_de_taller.php?respuesta=1'); 
			
	


?>
