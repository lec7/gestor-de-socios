<?php
/**
	Desarrollado por J.Carlos Gonzalez Torrijos; email:lec3578@gmail.com
	Sep.2016
**/

// El mensaje
$mensaje = "Línea 1\r\nLínea 2\r\nLínea 3";

// Si cualquier línea es más larga de 70 caracteres, se debería usar wordwrap()
$mensaje = wordwrap($mensaje, 70, "\r\n");

// Enviarlo
$bool=mail('miquelcanyada@gmail.com', 'Renovacion Labotario de Fabricacion', $mensaje);

if($bool){
    echo "Mensaje enviado";
}else{
    echo "Mensaje no enviado";
}


?>
