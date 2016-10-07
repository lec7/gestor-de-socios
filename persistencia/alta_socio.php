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
$_GET["DNI"] = explode("-" , $_GET["DNI"]);
$sql = "SELECT * FROM Socios WHERE DNI = '" . $_GET["DNI"] ."'";
$result = $conn->query($sql);

$sqlInsert = "INSERT INTO Socios( nombre, email, tlf, DNI, categoria, fecha_alta, fecha_inicio, fecha_fin, comentario)
				VALUES( '". $_GET["nombre"] . "','" . $_GET["email"]. "','" . $_GET["tlf"]."','" .  $_GET["DNI"]. "','" .$_GET["categoria"]. "','". $_GET["fecha_alta"] . "','". $_GET["fecha_inicio"] . "','" . $_GET["fecha_fin"] . "','" . $_GET["comentario"]."')";


//comprobamos si el email es correct, para posteriormente, al realizar el registro en la bda, enviar email. 

$email = $_GET["email"]; 
if (preg_match('/^([a-zA-Z0-9\._]+)\@([a-zA-Z0-9\.-]+)\.([a-zA-Z]{2,4})/',$email)){ 
  $valido = 1;     
} 
else{ 
  $valido = 0; 
}  						
/**
*******FUNCIONA*****
if ($conn->query($sqlInsert) === TRUE) {
			echo "Usuario registrado correctamente";

			//header('Location: /interfaz/solicitar_cita.php?respuesta=Usuario_Insertado');
		}
else {printf("Errormessage: %s\n", $conn->error);
	echo "<br>".$sqlInsert;
}	
*/					
	
//si hay resultados, avisamos que ya hay usuario con ese dni
	if ($result->num_rows > 0) 
		header('Location: /interfaz/alta_socio.php?respuesta=Existe_DNI'); 
		
	else {
		
		if ($conn->query($sqlInsert) === TRUE) {
			
			//hay que hacer envio de email de registro
			if($valido) {
			
			$nombre = $_GET["nombre"];
			// El mensaje
			$mensaje = "Buenos dias " . $nombre. " \r\n Ha sido dado en alta en el Laboratorio de Fabricacion";

			// Si cualquier línea es más larga de 70 caracteres, se debería 	usar wordwrap()
			$mensaje = wordwrap($mensaje, 70, "\r\n");
	
			//$email = $_GET["email"];
			// Enviarlo
			//$bool=mail($email, 'Alta en Labotario de Fabricacion', $mensaje);
			//echo $nombre;
			header('Location: /interfaz/alta_socio.php?respuesta=Insertado');
			}
			else{
			header('Location: /interfaz/alta_socio.php?respuesta=Insertado_No_enviado');
			}
		
	
		}
		else 
			header('Location: /interfaz/alta_socio.php?respuesta=Fallo');	
	}


?>
