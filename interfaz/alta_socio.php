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
          <input name="DNI" type="text" class="form-control" placeholder="DNI soci@" autocomplete="off">
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
//compruebo si existe la variable para evitar fallos
if ( isset($_GET["respuesta"]) )
	$respuesta = ($_GET["respuesta"]);

else $respuesta = "";

 //Si no se ha introducido numeros en dni o tlf
 	if($respuesta == "No_Numerico")
	 echo"	<FONT COLOR='red'>Ha habido un error, Tlf o DNI deben de ser numericos</FONT> <br> <br> ";
 //Si ya existe el DNI insertado
	else if($respuesta == "Existe_DNI"){
		echo"	<FONT COLOR='red'>El DNI introducido ya existe, intentelo de nuevo o compruebe que el usuario no esta dado ya de alta</FONT> <br> <br> ";
	}

	else if($respuesta == "Insertado"){
		echo"<FONT COLOR='green'>Soci@ dado de alta correctamente</FONT> <br> <br> ";
	echo "<meta http-equiv='refresh' content='5;url=./main.html'>";
	}
	else if($respuesta == "Insertado_No_enviado"){
		echo"<FONT COLOR='green'>Soci@ dado de alta correctamente, pero no se ha podido enviar email debido a email incorrecto</FONT> <br> <br> ";
	echo "<meta http-equiv='refresh' content='5;url=./main.html'>";
	}
	//Si ya existe el DNI insertado
	else if($respuesta == "Fallo"){
		echo"	<FONT COLOR='red'>Ha habido un fallo inesperado, intentelo de nuevo o contacte con un administrador</FONT> <br> <br> ";
	}
?>




<form  method="get" action="/control/alta_socio.php">
	<fieldset>	
	<h3>Alta de socio</h3>
	Nombre y apellidos: <input name="nombre" autocomplete="off">
	</br>
	E-mail:  <input name="email" autocomplete="off">
	</br>
	Tlf:  <input name="tlf" autocomplete="off">
	</br>
	DNI:  <input name="DNI" autocomplete="off"> 
	</br>
	Categoria del socio:  <input name="categoria" >
	</br>
	Comentario:  <textarea name='comentario' rows='5' cols='30'></textarea>
	</br>
	
	
    <button type="submit">Dar de alta</button>
	</fieldset>
</form>

</BODY>

</HTML>
