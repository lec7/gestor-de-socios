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

//Comprobamos si ya hay un socio con ese dni
$sql = "SELECT nombre FROM Grupos_de_trabajo";
$result = $conn->query($sql);

$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
		    $rows[] = $r;
		}
		$_SESSION["result"] = json_encode($rows);

header('Location: /interfaz/quitar_socio_de_grupo.php?respuesta=1'); 
			
	


?>
