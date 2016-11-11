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
//compruebo si existe la variable para evitar fallos
if ( isset($_GET["respuesta"]) )
	$respuesta = ($_GET["respuesta"]);

else $respuesta = "";

	if($respuesta == "No_Numerico"){
	echo"<FONT COLOR='red'>El tlf no ha sido insertado correctamente</FONT> <br> <br> ";
	} 
 	else if($respuesta == "Existe_DNI"){
		//cogemos los valores del socio, para mostrarlos y que el usuario pueda ver los que ya tiene antes de editarlos
		
		if ( isset($_SESSION["Resultado"]) )
		{

		$array = $_SESSION["Resultado"];
		
		$array = json_decode($array);
		
		
		foreach($array as $obj){
		     
			$numero = $obj->numero;
			$nombre = $obj->nombre;
			$email = $obj->email;
			$tlf = $obj->tlf;
			$DNI = $obj->DNI;
			$categoria = $obj->categoria;
			$fecha_alta = $obj->fecha_alta;
			$fecha_inicio = $obj->fecha_inicio;
			$fecha_fin = $obj->fecha_fin;
			$comentario = $obj->comentario;

			}
		
	
			

		
		 echo"	<form  method='get' action='/control/editar_socio.php'>
		<h3>Inserte los campos que desea editar de soci@ con DNI: '".	 $_GET	["DNI"]."'</h3> 
		<p style='font-size:15px'>(Los campos que no desee editar dejelos en blanco).</p>
		 
		Nombre y apellidos: <input name='nombre' value='".$nombre."' autocomplete='off'>
		</br>
		E-mail:  <input name='email' value='".$email."' autocomplete='off'>
		</br>
		Tlf:  <input name='tlf' value='".$tlf."' autocomplete='off'>
		</br>
		Categoria del socio:  <input name='categoria' value='".$categoria."' >
		</br>
		Comentario:  <textarea name='comentario'  rows='5' cols='30'>".$comentario."</textarea>
		</br>
		<input type='hidden' name='DNI' value='".$_GET["DNI"]."'>
	
	    <button type='submit'>Editar</button>
	</form> ";
	}//cierre isset($_SESSION["Resultado"]) 
 } //cierre $respuesta == "Existe_DNI"
	else if($respuesta == "Insertado"){
		echo"<FONT COLOR='green'>Soci@ editado correctamente</FONT> <br> <br> ";
	echo "<meta http-equiv='refresh' content='5;url=./main.html'>";
	}
	else if($respuesta == "No_existe"){
		echo"<FONT COLOR='red'>El DNI insertado no corresponde a 	ningun soci@ dado de alta en el sistema</FONT> <br> <br> ";
	}
	else if($respuesta == "Editado"){
		echo"<FONT COLOR='green'>Soci@ editado correctamente</FONT> <br> <br> ";
	}

?>


<form  method="get" action="/control/existe_socio.php" class="form-horizontal">
	<fieldset>	
	<h3>Inserte el DNI de soci@ que desea editar</h3>
	
	DNI:  <input name="DNI" autocomplete='off'>
	</br>
	
	
    <button type="submit">Editar</button>
	</fieldset>
</form>

</BODY>

</HTML>
