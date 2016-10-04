<!DOCTYPE HTML>
<!--
	Desarrollado por J.Carlos Gonzalez Torrijos; email:lec3578@gmail.com
-->
<HEAD>

<title>Main</title>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.min.css">
<link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="./assets/dateTimePicker.css">
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
          <input name="DNI" type="text" class="form-control" placeholder="DNI soci@">
        </div>
        <button type="submit" class="btn btn-default">Ver soci@</button>
      </form>
      <a id="envio" class="navbar-brand" >Envio correos</a>
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

//inicializo variables
$numero;
$nombre;
$email;
$tlf;
$DNI;
$categoria;
$fecha_alta;
$fecha_inicio;
$fecha_fin;
$fecha_actual = date('Y-m-d');
$comentario;
$str = "";
 if($respuesta == "Existe_DNI"){

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
		
	
			//eliminar la session.
			//session_unset();
	
		}//cierre if isset de arriba
	
	
	$activo;
	$fecha_actual1 = new DateTime($fecha_actual);
	$fecha_fin1 = new DateTime($fecha_fin);
	
	if($fecha_actual1 <= $fecha_fin1) $activo = 1;
	else $activo = 0;
	echo "Activo:";
	if( $activo == 1) 
				echo "<img src='assets/img/ok.png' height='50' width='50'>";
			else echo "<img src='assets/img/no.png' height='50' width='50'>";
	//Mostrar informacion del soci@
	echo "
		 <div class='row'>
        <div class='col-md-4'>

		<h2>Datos del soci@:</h2> </br>
		<p>Numero de soci@: " . $numero . "<br>		
		Nombre: " . $nombre . "<br>
		E-mail: " . $email . "<br>
		Tlf: " . $tlf . "<br>
		DNI: " . $DNI . "<br>
		Categoria: " . $categoria . "<br>
		Fecha de alta: " . $fecha_alta . "<br>
		Fecha de inicio del periodo: " . $fecha_inicio . "<br>
		Fecha de fin del periodo: " . $fecha_fin . "<br>
		Comentarios: " . $comentario . "<br>
		</p>
		</div>	
		";
			


		echo "";
			
	//Guardar fechas que ha pagado
	$fecha_inicio;
	$fecha_actual1;
	$fecha_fin1;
	$todayh = getdate();
	$d = $todayh['mday']; 
     	$m = $todayh['mon']; 
     	$y = $todayh['year'];
	//guardamos fecha inicio periodo
	//quitamos el - en la fecha
	$f = explode("-" , $fecha_inicio);
	$y_i = $f[0];
	$m_i = $f[1];
	$d_i = $f[2];
	echo "</br>
			
		
	<div class='col-md-4'>
        <div class='col-xss-4'>
		<h2> Calendario </h2>
		 
          <div id='basic' data-toggle='calendar'></div>
		<p>hoy es:". $y . "-" . $m . "-" . $d . "</p>
        </div>
        
     </div>";
	
	
	$datetime1 = date_create($fecha_inicio);
	$datetime2 = date_create($fecha_fin);
	$interval = date_diff($datetime1, $datetime2);
	$dif = (int)$interval->format('%r%a');
	$str = "";
	//si dif >=0 es que aun tiene dias por delante
	
	if($dif >= 0) {
	
		$i = 0;
		//$fecha =  $y . "-" . $m;
		//guardamos dias en que se empezo el periodo
		// d_i - 1 pq si no empieza al dia siguiente
		$d = $d_i-1;
		$m = $m_i;
		$y = $y_i;
		$str = "['". $fecha_actual ;
		
		while($i < $dif){
			
		
		//comprobamos cambios de mes y de año
		if($m == 1 OR $m == 3 OR $m == 5 OR $m == 7 OR $m == 8 OR $m == 10 OR $m == 12) {
			if($m == 12 AND $d == 31) {$y = $y+1; $m = 1; $d = 1;}
			else if($d >= 31){ $d = 1; $m = $m+1;}

			
			else $d = $d+1;
		}//cierre if meses 31

		

		else if ($m == 2 OR $m == 4 OR $m == 6 OR $m == 9 OR $m == 11){
			if($m == 2){
				if($d >= 28) {$d = 1; $m = $m+1;}
				else $d = $d + 1;
			}

			else if($d >= 30) {$d = 1; $m = $m+1;}
			else $d = $d + 1;
		}//cierre if meses 30
		

		$fecha = $y . "-" .$m . "-" . $d;
		$str = $str . "','" . $fecha;
		
		$i = $i+1;
		
		}//cierre while
		
		$str = $str . "']";
	
	
	}//cierre if principal 
	

	 }
	else if($respuesta == "No_existe"){
		echo"<FONT COLOR='red'>El DNI insertado no corresponde a ningun soci@ dado de alta en el sistema</FONT> <br> <br> ";
	}
	


?>






   <script type="text/javascript" src="scripts/components/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/dateTimePicker.min.js"></script>
<?php
if($str != ""){
echo "	    <script type='text/javascript'>

$(document).ready(function()

    {
      $('#basic').calendar(
      {
        day_first: 1,
	unavailable:". $str . ",
	available: ['" .$fecha_actual ."']
      });

});
    </script>";
}

else echo "	    <script type='text/javascript'>

$(document).ready(function()

    {
      $('#basic').calendar(
      {
        day_first: 1
      });

});
    </script>";

?>



  				<?php
				
		if ( isset($_SESSION["cursos"]) ){
		
		echo "
		
        <div class='col-md-4'>
	<div class='col-xss-4'>
		<h2> Maquinas: </h2> </br><ul>";

		$array = $_SESSION["cursos"];
		
		$array = json_decode($array);
		$nombres;
		$cont = 0;
		foreach($array as $obj){
		     
			$nombres[$cont] = $obj->maquina;
			$cont = $cont + 1;
			}
		
	
			//eliminar la session.
			//session_unset();
				$i = 0;
				while($i < $cont){
				echo "<li>".$nombres[$i] ."</li>";
				$i = $i + 1;
				}
				//eliminar la session.
				//session_unset();
			echo "</ul>
			
			
			";
		}
	?>



		<?php

		if ( isset($_SESSION["grupos"]) ){
			echo "
			
			<h2> Grupos trabajo: </h2> </br>
<ul>";
			//Mostramos los cursos 		
		$array = $_SESSION["grupos"];
		
		$array = json_decode($array);
		$nombres;
		$cont = 0;
		foreach($array as $obj){
		     
			$nombres[$cont] = $obj->grupo_trabajo;
			$cont = $cont + 1;
			}
		
				$i = 0;
				while($i < $cont){
				echo "<li>".$nombres[$i] ."</li>";
				$i = $i + 1;
				}
			echo "</ul>";
}
			//MOSTRAMOS LOS TALLERES
			if ( isset($_SESSION["talleres"]) ){
			echo "
			
			<h2> Talleres: </h2> </br>
<ul>";
			//Mostramos los talleres 		
		$array = $_SESSION["talleres"];
		
		$array = json_decode($array);
		$nombres;
		$cont = 0;
		foreach($array as $obj){
		     
			$nombres[$cont] = $obj->taller;
			$cont = $cont + 1;
			}
		
				$i = 0;
				while($i < $cont){
				echo "<li>".$nombres[$i] ."</li>";
				$i = $i + 1;
				}


				//eliminar la session.
				session_unset();
				echo "</div> </div> </ul>";				
				}
		?>
				

<!--
<form  method="get" action="/control/comprobar_socio.php" class="form-horizontal">
	<fieldset>
	<h3>Inserte el DNI de soci@ que desea comprobar</h3>
	
	DNI:  <input name="DNI">
	</br>
	
	
    <button type="submit">Consultar</button>
	</fieldset>
</form>
-->
</BODY>

</HTML>
