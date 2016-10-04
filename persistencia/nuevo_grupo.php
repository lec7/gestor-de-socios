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


$sql = "SELECT * FROM Grupos_de_trabajo WHERE nombre = '" . $_GET["nombre"]."'" ;
echo $sql;
$sqlInsert = "INSERT INTO Grupos_de_trabajo(nombre, descripcion) VALUES( '". $_GET["nombre"] . "','" . $_GET["descripcion"]. "')";
echo $sqlInsert;

$result = $conn->query($sql);



	if ($result->num_rows > 0) 	
		
		header('Location: /interfaz/nuevo_grupo.php?respuesta=Existe'); 
		
	else {
		if ($conn->query($sqlInsert) === TRUE)
	header('Location: /interfaz/nuevo_grupo.php?respuesta=OK');
	
	}
			
	


?>
