<?php
/**
	Desarrollado por J.Carlos Gonzalez Torrijos; email:lec3578@gmail.com
	Sep.2016
**/
if( !is_numeric($_GET["tlf"])  ) 
	header('Location: /interfaz/alta_socio.php?respuesta=No_Numerico');
else {

//para que al insertar un nuevo socio, NO se inserte automaticamente un mes pagado, hay que insertarlo	
$fecha_inicio = date('Y-m-d');
$fecha_fin = $fecha_inicio;
//$fecha_fin = date('Y-m-d', strtotime('+1 month'));

	header('Location: /persistencia/alta_socio.php?nombre=' .$_GET["nombre"]. "&email=". $_GET["email"] . "&tlf=" . $_GET["tlf"] . "&DNI=" . $_GET["DNI"] . "&categoria=" . $_GET["categoria"] . "&comentario=" . $_GET["comentario"] . "&fecha_inicio=" .$fecha_inicio ."&fecha_fin=" .$fecha_fin ."&fecha_alta=" .$fecha_inicio);




}


?>
