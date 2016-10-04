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


//$result = $conn->query($sql);

//Montamos la consulta SET, con los parametros que han sido insertados para actualizar

$sqlUpdate = "UPDATE Socios SET ";

if($_GET["nombre"]!= "") $sqlUpdate = $sqlUpdate . "nombre='" . $_GET		["nombre"] . "' ,"; 

	if($_GET["email"] != "") $sqlUpdate = $sqlUpdate . "email='" . $_GET		["email"] . "' ,";

	if($_GET["tlf"] != "") $sqlUpdate = $sqlUpdate . "tlf='" . $_GET		["tlf"] . "' ,";

	if($_GET["categoria"] != "") $sqlUpdate = $sqlUpdate . "categoria='" . $_GET		["categoria"] . "' ,";

	if($_GET["comentario"] != "") $sqlUpdate = $sqlUpdate . "comentario='" . $_GET		["comentario"] . "' ,";

//para quitar la ultima "," coma, sobrante. 
$sqlUpdate = trim($sqlUpdate, ',');

$sqlUpdate = $sqlUpdate . " WHERE DNI = '" .$_GET["DNI"] . "'";


	
		if ($conn->query($sqlUpdate) === TRUE) 
			
			header('Location: /interfaz/editar_socio.php?respuesta=Editado');
		
		else  //{printf("Errormessage: %s\n", $conn->error);
			//echo "<br>".$sqlUpdate;}
		header('Location: /interfaz/alta_socio.php?respuesta=Fallo');	
		


?>
