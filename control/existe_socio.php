<?php
/**
	Desarrollado por J.Carlos Gonzalez Torrijos; email:lec3578@gmail.com
	Sep.2016
**/
//if(  !is_numeric($_GET["DNI"]) ) 
	//header('Location: /interfaz/editar_socio.php?respuesta=No_Numerico');
//else {
	header('Location: /persistencia/existe_socio.php?DNI='.$_GET["DNI"]);

//}


?>
