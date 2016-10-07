<?php
/**
	Desarrollado por J.Carlos Gonzalez Torrijos; email:lec3578@gmail.com
	Sep.2016
**/
session_start();

//si existe, es que ya hemos preguntado, por lo que enviamos correos.
if ( isset($_SESSION["Resultado"]) )
{

$array = $_SESSION["Resultado"];

$array = json_decode($array);

$array2 = $_SESSION["Resultado2"];

$array2 = json_decode($array2);
/**print_r($array);
echo "</br>";
echo $array[0]->nombre;

if($_GET["hay"]) echo "hay";
else echo "no hay";
**/
if($_GET["hay"]){
foreach($array as $obj){
     

	$nombre = $obj->nombre;
	// El mensaje
	$mensaje = "¡Hola ".$nombre."! \r\n

Este es un mensaje generado automáticamente desde la base de datos del Laboratorio de Fabricación, el cual tiene como función avisarte de que quedan 5 días para renovar la cuota de socio por un mes más (¡o los que quieras!).\r\n

Para renovarla tienes dos opciones, \r\n
Puedes pasarte por el Laboratorio de Fabricación y abonarlo directamente allí (C/Poeta Carles Salvador, 8 BJ - C - 46020).
O puedes hacer una transferencia al siguiente número de cuenta: ES91 3159 0063 5724 7888 5722 - Asociación Cultural Laboratorio de Fabricación - Caixa Popular.\r\n
Muchas gracias!\r\n
Nos vemos pronto! :)\r\n

El Equipo Laboratorio de Fabricación.";

	// Si cualquier línea es más larga de 70 caracteres, se debería 	usar wordwrap()
	$mensaje = wordwrap($mensaje, 70, "\r\n");
	
	$email = $obj->email;
	// Enviarlo
	$bool=mail($email, 'Renovacion Labotario de Fabricacion', $mensaje);

	if($bool){
	    echo "Mensaje enviado a: ".$email ."</br>";
	}else{
	    echo "Mensaje no enviado";
		
	}
	}

	//Enviamos correos a socios que finalicen hoy
	foreach($array2 as $obj){
     

	$nombre = $obj->nombre;
	$nombre = htmlentities($nombre);
	// El mensaje
	$mensaje = "¡Hola ".$nombre."! \r\n

Este es un mensaje generado automáticamente desde la base de datos del Laboratorio de Fabricación, el cual tiene como función avisarte de que se acaba de finalizar tu periodo como soci@ de la asociación, aunque aún puedes renovar la cuota de socio por un mes más (¡o los que quieras!).\r\n

Para renovarla tienes dos opciones, \r\n
Puedes pasarte por el Laboratorio de Fabricación y abonarlo directamente allí (C/Poeta Carles Salvador, 8 BJ - C - 46020).
O puedes hacer una transferencia al siguiente número de cuenta: ES91 3159 0063 5724 7888 5722 - Asociación Cultural Laboratorio de Fabricación - Caixa Popular.\r\n
Muchas gracias!\r\n
Nos vemos pronto! :)\r\n

El Equipo Laboratorio de Fabricación.";

	// Si cualquier línea es más larga de 70 caracteres, se debería 	usar wordwrap()
	$mensaje = wordwrap($mensaje, 70, "\r\n");
	
	$email = $obj->email;
	// Enviarlo
	$bool=mail($email, 'Renovacion Labotario de Fabricacion', $mensaje);

	if($bool){
	    echo "Mensaje enviado a: ".$email."</br>";
	}else{
	    echo "Mensaje no enviado";
		
	}

	}

	
	}//cierre if hay socios que finalizan
	else if($_GET["hay"]==0) echo"No hay socios que finalicen en 5 u 0 dias, no es necesario enviar ningun correo";
	//eliminar la session.
	session_unset();
	echo "<meta http-equiv='refresh' content='10;url=../interfaz/main.html'>";
}//cierre if isset de arriba

//si no existe, hay que preguntar si hay socios
else{

//obtengo la fecha actual, y le sumo 5 dias, para avisar a los socios que se les acaba el periodo en 5 dias.

$fecha_sumada = date('Y-m-d', strtotime('+5 days'));
$fecha_actual = date('Y-m-d');

header('Location: /persistencia/socios_fin_periodo.php?fecha=' .$fecha_sumada.'&fecha2='.$fecha_actual);


}

?>
