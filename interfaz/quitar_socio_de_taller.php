<!DOCTYPE HTML>
<!--
	Desarrollado por J.Carlos Gonzalez Torrijos; email:lec3578@gmail.com
	Sep.2016
-->
<HEAD>

<title>Main</title>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.min.css">

<script type="text/javascript" src="./assets/js/jquery.js" charset="UTF-8"></script>

<script type="text/javascript" src="./assets/js/bootstrap.min.js" charset="UTF-8"></script>


</HEAD>



<BODY>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
	<a class="navbar-brand" href="/interfaz/alta_socio.php">Alta de soci@</a>

	<a class="navbar-brand" href="/interfaz/pago.php">Introducir pago</a>
	
	<a class="navbar-brand" href="/interfaz/editar_socio.php">Editar soci@</a>



	

    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Grupos y cursos <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="/interfaz/nuevo_grupo.php">Crear grupo de trabajo</a></li>
            <li><a href="/interfaz/meter_socio_en_grupo.php">Añadir soci@ a grupo de trabajo</a></li>
           <li><a href="/interfaz/quitar_socio_de_grupo.php">Quitar soci@ de grupo de trabajo</a></li>
            <li class="divider"></li>
		  <li><a href="/interfaz/nuevo_taller.php">Crear taller</a></li>
            <li><a href="/interfaz/meter_socio_en_taller.php">Añadir soci@ a taller</a></li>
		<li><a href="/interfaz/quitar_socio_de_taller.php">Quitar soci@ de taller</a></li>

	    <li class="divider"></li>
            <li><a href="/interfaz/curso_socio.php">Soci@ con acceso a maquina</a></li>
            
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" role="search" action="/control/comprobar_socio.php">
        <div class="form-group">
          <input name="DNI" type="text" class="form-control" placeholder="DNI soci@" autocomplete='off'>
        </div>
        <button type="submit" class="btn btn-default">Ver soci@</button>
      </form>
      <a  class="navbar-brand" href="/persistencia/listar_socios.php" >Listar soci@s</a>
 	
	 <a id="envio" class="navbar-brand" style="cursor: pointer; cursor: hand;">Envio correos</a>
    </div>
		
  </div>
</nav>
<script>
envio.onclick=function(){
var answer = confirm ("Estas seguro que quieres enviar correos?");
if(answer){
 	window.location.replace("/control/cron_email.php");
}
else {
	window.location.replace("/interfaz/main.html");
}
}
</script>


<?php

session_start();

if ( isset($_GET["respuesta"]) )
	$respuesta = ($_GET["respuesta"]);

else $respuesta = "";

if($respuesta == "")
header('Location: /persistencia/nombre_talleres2.php');

$result = $_SESSION["result"];


 if($respuesta == "No_existe"){
		echo"<FONT COLOR='red'>El DNI insertado no esta registrado en el sistema</FONT> <br> <br> ";
	}

	
  else if($respuesta == "No_existe2"){
		echo"<FONT COLOR='red'>El Taller insertado no esta registrado en el sistema</FONT> <br> <br> ";
	}

	else if($respuesta == "NO_Existe"){
		echo"<FONT COLOR='red'>El Soci@ con ese DNI no esta registrado en ese taller </FONT> <br> <br> ";
	}

	else if($respuesta == "OK") {
		echo"<FONT COLOR='green'>Soci@ eliminado correctamente</FONT> <br> <br> <meta http-equiv='refresh' content='5;url=./main.html'>";
	}
?>




<form  method="get" action="/persistencia/quitar_socio_de_taller.php" class="form-horizontal">
	<fieldset>
	<h3>Quitar soci@ de un taller</h3>
	
	DNI:  <input name="DNI" autocomplete="off"> </br>
	Taller: <input list="taller" name="taller" autocomplete="off">
				<datalist id="taller">
  				<?php
				

		$array = $_SESSION["result"];
		
		$array = json_decode($array);
		$nombres;
		$cont = 0;
		foreach($array as $obj){
		     
			$nombres[$cont] = $obj->nombre;
			$cont = $cont + 1;
			}
		
	
			//eliminar la session.
			//session_unset();
				$i = 0;
				while($i <= $cont){
				echo "<option value='".$nombres[$i] . "'>".$nombres[$i]."</option>";
				$i = $i + 1;
				}
				//eliminar la session.
				//session_unset();
				?>
				</datalist> 
				</input>
	</br>
	
	
    <button type="submit">Eliminar</button>
	</fieldset>
</form>

</BODY>

</HTML>
