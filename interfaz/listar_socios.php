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

if ( isset($_SESSION["Resultado"]) )
		{
		
		$array = $_SESSION["Resultado"];
		
		$array = json_decode($array);
		echo "<table class='table table-striped table-hover '>
			  <thead>
			    <tr>
			      	<th>#</th>
				<th>Activo</th>
			      	<th>Nombre</th>
			      	<th>Email</th>
			      	<th>Tlf</th>
				<th>DNI</th>
				<th>Categoria</th>
				<th>Fecha de Alta</th>
				<th>Fecha de Inicio Periodo</th>
				<th>Fecha de Fin Periodo</th>
				<th>Comentario</th>
				<th>Grupos</th>
				<th>Talleres</th>
			    </tr>
			  </thead>
			  <tbody>";
		
		foreach($array as $obj){
		     echo"<tr>";
			echo "<td>";
			echo $numero = $obj->numero;
			echo "</td>";
			echo "<td>";

				$activo;
				$fecha_actual = date('Y-m-d');
				$fecha_fin = $obj->fecha_fin;
				$fecha_actual1 = new DateTime($fecha_actual);
				$fecha_fin1 = new DateTime($fecha_fin);
	
				if($fecha_actual1 <= $fecha_fin1) $activo = 1;
				else $activo = 0;
				
				if( $activo == 1) 
					echo "<img src='assets/img/ok.png' height='30' width='30'>";
				else 	echo "<img src='assets/img/no.png' height='30' width='30'>";

			echo "</td>";  
			echo "<td>";
			echo $nombre = $obj->nombre;
			echo "</td>";
			echo "<td>";
			echo $email = $obj->email;
			echo "</td>";
			echo "<td>";
			echo $tlf = $obj->tlf;
			echo "</td>";
			echo "<td>";
			echo $DNI = $obj->DNI;
			echo "</td>";
			echo "<td>";
			echo $categoria = $obj->categoria;
			echo "</td>";
			echo "<td>";
			echo $fecha_alta = $obj->fecha_alta;
			echo "</td>";
			echo "<td>";
			echo $fecha_inicio = $obj->fecha_inicio;
			echo "</td>";
			echo "<td>";
			echo $fecha_fin = $obj->fecha_fin;
			echo "</td>";
			echo "<td>";
			echo $comentario = $obj->comentario;
			echo "</td>";
			
			//mostramos grupos			
			$sql3 = "SELECT * FROM Grupo_socio WHERE socio = '" . $DNI."'";
		$result3 = $conn->query($sql3);
		
		$rows3 = array();
		while($r = mysqli_fetch_assoc($result3)) {
		    $rows3[] = $r;
		}
		$array = json_encode($rows3);	
		
		
		$array = json_decode($array);
		$nombres;
		$cont = 0;
		foreach($array as $obj){
		     
			$nombres[$cont] = $obj->grupo_trabajo;
			$cont = $cont + 1;
			}
				echo "<td>";
				$i = 0;
				while($i < $cont){
				echo $nombres[$i] .",  ";
				$i = $i + 1;
				}
			echo "</td>";

			
				//mostramos talleres			
			$sql3 = "SELECT * FROM Taller_socio WHERE socio = '" . $DNI."'";
		$result3 = $conn->query($sql3);
		
		$rows3 = array();
		while($r = mysqli_fetch_assoc($result3)) {
		    $rows3[] = $r;
		}
		$array = json_encode($rows3);	
		
		
		$array = json_decode($array);
		$nombres;
		$cont = 0;
		foreach($array as $obj){
		     
			$nombres[$cont] = $obj->taller;
			$cont = $cont + 1;
			}
				echo "<td>";
				$i = 0;
				while($i < $cont){
				echo $nombres[$i] .",  ";
				$i = $i + 1;
				}
			echo "</td>";
			
			}//cierre foreach superior
		
		echo "</tbody>	</table> ";
			//eliminar la session.
			//session_unset();
	
		}//cierre if isset de arriba
	else echo "no";
?>

</BODY>

</HTML>
