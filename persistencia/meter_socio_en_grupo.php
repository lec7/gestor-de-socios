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
$sql = "SELECT * FROM Socios WHERE DNI = '" . $_GET["DNI"]."'" ;

$sql2 = "SELECT * FROM Grupos_de_trabajo WHERE nombre = '" . $_GET["grupo"]."'" ;

$sqlInsert = "INSERT INTO Grupo_socio(grupo_trabajo, socio) VALUES( '". $_GET["grupo"] . "','" . $_GET["DNI"]. "')";


$result = $conn->query($sql);
$result2 = $conn->query($sql2);

//si no hay resultados, avisar que no hay socio con ese DNI
	if ($result->num_rows < 1) 	
		
		header('Location: /interfaz/meter_socio_en_grupo.php?respuesta=No_existe'); 
		

	else if ($result2->num_rows < 1) 	
		
		header('Location: /interfaz/meter_socio_en_grupo.php?respuesta=No_existe2'); 
		
	else {
	//Comprobamos que no esta ya registrado un dni con un grupo de trabajo
	
	$sql3 = "SELECT * FROM Grupo_socio WHERE grupo_trabajo = '". $_GET["grupo"] . "' AND socio = '". $_GET["DNI"] . "'";	

	//preguntamos a la base de datos si ya esta registrado ese dni y ese grupo de trabajo
	$result3 = $conn->query($sql3);
	echo $result3->num_rows;
	//si no esta registrado, pues lo registramos
	if($result3->num_rows < 1){
		
		if ($conn->query($sqlInsert) === TRUE) 
		header('Location: /interfaz/meter_socio_en_grupo.php?respuesta=OK'); 
	
	}

	else header('Location: /interfaz/meter_socio_en_grupo.php?respuesta=Existe');

	}//cierre else de la comprobacion
?>
