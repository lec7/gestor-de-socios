<?php
/**
	Desarrollado por J.Carlos Gonzalez Torrijos; email:lec3578@gmail.com
	Sep.2016
**/
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "labotario_de_fabricacion";

session_start();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Comprobamos si ya hay un socio con ese dni
$sql = "SELECT * FROM Socios WHERE DNI = '" . $_GET["DNI"]."'" ;
$result = $conn->query($sql);

	
		

//si hay resultados, avisamos que ya hay usuario con ese dni
	if ($result->num_rows > 0) {	
		$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
		    $rows[] = $r;
		}
		$_SESSION["Resultado"] = json_encode($rows);
		header('Location: /interfaz/editar_socio.php?respuesta=Existe_DNI&DNI='. $_GET["DNI"]); 
	}	
	else {
		
	header('Location: /interfaz/editar_socio.php?respuesta=No_existe');
	
	}
			
	


?>
