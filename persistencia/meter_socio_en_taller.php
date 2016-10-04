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

//if(  !is_numeric($_GET["DNI"]) ) 
	//header('Location: /interfaz/meter_socio_en_taller.php?respuesta=No_existe');
	


//Comprobamos si ya hay un socio con ese dni
$sql = "SELECT * FROM Socios WHERE DNI = '" . $_GET["DNI"]."'" ;

$sql2 = "SELECT * FROM Taller WHERE nombre = '" . $_GET["taller"]."'" ;

$sqlInsert = "INSERT INTO Taller_socio(taller, socio) VALUES( '". $_GET["taller"] . "','" . $_GET["DNI"]. "')";


$result = $conn->query($sql);
$result2 = $conn->query($sql2);

//si no hay resultados, avisar que no hay socio con ese DNI
	if ($result->num_rows < 1) 	
		
		header('Location: /interfaz/meter_socio_en_taller.php?respuesta=No_existe'); 
		

	else if ($result2->num_rows < 1) 	
		
		header('Location: /interfaz/meter_socio_en_taller.php?respuesta=No_existe2'); 
		
	else {
	//Comprobamos que no esta ya registrado un dni con un grupo de trabajo
	
	$sql3 = "SELECT * FROM Taller_socio WHERE taller = '". $_GET["taller"] . "' AND socio = '". $_GET["DNI"] . "'";	

	//preguntamos a la base de datos si ya esta registrado ese dni y ese grupo de trabajo
	$result3 = $conn->query($sql3);
	echo $result3->num_rows;
	//si no esta registrado, pues lo registramos
	if($result3->num_rows < 1){
		
		if ($conn->query($sqlInsert) === TRUE) 
		header('Location: /interfaz/meter_socio_en_taller.php?respuesta=OK'); 
	
	}

	else header('Location: /interfaz/meter_socio_en_taller.php?respuesta=Existe');

	}//cierre else de la comprobacion
?>
