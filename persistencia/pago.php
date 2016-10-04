<?php
/**
	Desarrollado por J.Carlos Gonzalez Torrijos; email:lec3578@gmail.com
	Sep.2016
**/
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
$sql = "SELECT * FROM Socios WHERE DNI = '" . $_GET["DNI"] ."'";
$result = $conn->query($sql);



	if ($result->num_rows > 0) {
	$sqlUpdate = "UPDATE Socios SET fecha_inicio = '" . $_GET["fecha_inicio"] ."', fecha_fin = '" . $_GET["fecha_fin"] . "' WHERE
			DNI = '". $_GET["DNI"] . "'";
	
	if ($conn->query($sqlUpdate) === TRUE) 
			
		header('Location: /interfaz/pago.php?			respuesta=Editado');
		
	else  	header('Location: /interfaz/pago.php?			respuesta=Fallo');	
		
	
}

else {
		
	header('Location: /interfaz/pago.php?respuesta=No_existe');
	
	}	
		
			
	


?>
