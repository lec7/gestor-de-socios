<?php
/**
	Desarrollado por J.Carlos Gonzalez Torrijos; email:lec3578@gmail.com
	Sep.2016
**/
if(  !is_numeric($_GET["meses"]) ) 
header('Location: /interfaz/pago.php?respuesta=No_Numerico');
else {

//asi, por cada mes que hayamos indicado, se cambia la fecha de fin

$meses = $_GET["meses"];
$fecha_fin = date('Y-m-d', strtotime('+'.$meses.' month'));
$fecha_inicio = date('Y-m-d');

header('Location: /persistencia/pago.php?DNI=' .$_GET["DNI"]. "&fecha_fin=". $fecha_fin . "&fecha_inicio=". $fecha_inicio);

}


?>
