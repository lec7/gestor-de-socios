<?php
/**
	Desarrollado por J.Carlos Gonzalez Torrijos; email:lec3578@gmail.com
	Sep.2016
**/
//if( !is_numeric($_GET["tlf"]) && $_GET["tlf"]!= "" ) 
	//header('Location: /interfaz/editar_socio.php?respuesta=No_Numerico');
//else {
	
header('Location: /persistencia/editar_socio.php?nombre=' .$_GET["nombre"]. "&email=". $_GET["email"] . "&tlf=" . $_GET["tlf"] . "&DNI=" . $_GET["DNI"] . "&categoria=" . $_GET["categoria"] . "&comentario=" . $_GET["comentario"]);




//}


?>
