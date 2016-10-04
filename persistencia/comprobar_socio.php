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
$sql = "SELECT * FROM Socios WHERE DNI = '" . $_GET["DNI"]."'" ;
$result = $conn->query($sql);



	if ($result->num_rows > 0) {	
		
		$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
		    $rows[] = $r;
		}
		$_SESSION["Resultado"] = json_encode($rows);
		

		//buscar cursos realizados
	
		$sql2 = "SELECT * FROM Cursos WHERE DNI = '" . $_GET["DNI"]."'";
		$result2 = $conn->query($sql2);
		
		$rows2 = array();
		while($r = mysqli_fetch_assoc($result2)) {
		    $rows2[] = $r;
		}
		$_SESSION["cursos"] = json_encode($rows2);		
		
		$array = $_SESSION["cursos"];
		
		$array = json_decode($array);
		foreach($array as $obj){
		     
			echo $obj->maquina;
			
			}
		//buscar grupos de trabajo

		
		$sql3 = "SELECT * FROM Grupo_socio WHERE socio = '" . $_GET["DNI"]."'";
		$result3 = $conn->query($sql3);
		
		$rows3 = array();
		while($r = mysqli_fetch_assoc($result3)) {
		    $rows3[] = $r;
		}
		$_SESSION["grupos"] = json_encode($rows3);	


		//buscar talleres

		
		$sql3 = "SELECT * FROM Taller_socio WHERE socio = '" . $_GET["DNI"]."'";
		$result3 = $conn->query($sql3);
		
		$rows3 = array();
		while($r = mysqli_fetch_assoc($result3)) {
		    $rows3[] = $r;
		}
		$_SESSION["talleres"] = json_encode($rows3);	


		header('Location: /interfaz/comprobar_socio.php?respuesta=Existe_DNI&DNI='. $_GET["DNI"]); 
	}	
	else {
		
	header('Location: /interfaz/comprobar_socio.php?respuesta=No_existe');
	
	}
			
	


?>
