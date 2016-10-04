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
	//header('Location: /interfaz/curso_socio.php?respuesta=No_existe');
	


//Comprobamos si ya hay un socio con ese dni
$sql = "SELECT * FROM Socios WHERE DNI = '" . $_GET["DNI"]."'" ;

$sqlInsert = "INSERT INTO Cursos (DNI, maquina) VALUES( '". $_GET["DNI"] . "','" . $_GET["maquina"]. "')";


$result = $conn->query($sql);


//si no hay resultados, avisar que no hay socio con ese DNI
	if ($result->num_rows < 1) 	
		
		header('Location: /interfaz/curso_socio.php?respuesta=No_existe'); 
		
		
	else {
	//Comprobamos que no esta ya registrado un dni con un grupo de trabajo
	
	$sql3 = "SELECT * FROM Cursos WHERE DNI = '". $_GET["DNI"] . "' AND maquina = '". $_GET["maquina"] . "'";	
	
	//preguntamos a la base de datos si ya esta registrado ese dni y ese curso
	$result3 = $conn->query($sql3);
	
	//si no esta registrado, pues lo registramos
	if($result3->num_rows < 1){
		echo "entra";
		echo $sqlInsert;
		if ($conn->query($sqlInsert) === TRUE){
			
			
		header('Location: /interfaz/curso_socio.php?respuesta=OK'); 
	}
	}

	else header('Location: /interfaz/curso_socio.php?respuesta=Existe');

	}//cierre else de la comprobacion
?>
