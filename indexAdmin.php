<?php

ini_set('display_errors', 1);
include_once("Session.php");
Session::init();
//Session::destroy();
if(!Session::get('autenticado')){
   header('Location: login.php'); 
	exit();
} 
if (0 !=   strcasecmp("admin", Session::get('level') ))
 {
	header('Location: index.php'); 
   	exit(); 	

 }

$idUser=Session::get('id_usuario');
$user=Session::get('user');
$passID=Session::get('password'); 

?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link href='ideaicon.ico' rel='shortcut icon' type='image/x-icon'>
	<title>Control Servicio  :ADMIN:</title>
	     <link rel="stylesheet" type="text/css" href="css/menu.css" media="screen"  />
	     <link rel="stylesheet" type="text/css" href="css/principal.css"/>
	     <link rel="stylesheet" type="text/css" href="css/MiFormulario.css"/>
	     
	        <!-- calendar stylesheet -->
	        <link rel="stylesheet" type="text/css" href="calendarioCSS/calendar-system.css" title="green" />
	        <!-- main calendar program -->
	        <script type="text/javascript" src="calendarioJS/calendar.js"></script>
	        <!-- language for the calendar -->
	        <script type="text/javascript" src="calendarioJS/calendar-es.js"></script>
	        <!-- the following script defines the Calendar.setup helper function, which makes
	             adding a calendar a matter of 1 or 2 lines of code. -->
	        <script type="text/javascript" src="calendarioJS/calendar-setup.js"></script>
	<script type="text/javascript" src="js/jquery/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="js/jquery/jquery-ui-1.8.9.custom.min.js"></script>
	<script src="js/interaccionAdmin.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/menu.js"></script>
	</head>
<body>
	<!-- CARGADOR DE ESPERA -->
	<div id="cargador" class="cargador">
		<div id="espera">
		   <!--  <img id="closeEspera" src="img/close.png" alt="closeEspera" /> -->
			<span class="TextoEspera">
				Espere un momento por favor
			</span>
			<div id="imgEspera"></div>
		</div>
	</div>
	<div class="contenedorEmergente">
		<div id="table-content"></div>
	</div>
	<!-- FIN CARGADOR DE ESPERA -->
<div id="cabecera">
    <div class="nav-divider">&nbsp;</div>
    <div id="logo">
	   <a href=""><img src="images/shared/logo.jpg" width="43" height="65" alt="" /></a>
	   <div id="datosUser">
			<p>
				<ul>
					<li>
						Usuario:  <?PHP echo "". Session::get('usuario') ." " ?>
					</li>
					<li>
						Tipo: <?= Session::get('level')?>
					</li>
					<li>
						<a href="cerrarSesion.php" id="logout">
							logout
						</a>
					</li>
				</ul>
			</p>
		</div>
	</div>
<!-- ************************************************************************************************************************* -->	
	<div id="menu">
	  <ul name="menuCustomer" >
	 	<li class="g-button g-button-white selected "  id="homeAdmin">
	 		 <label for="">Inicio</label>
	 	</li>
	 	<li class="g-button g-button-white "  id="vistaSolicitudesEnviadas">
	 		 <label for="" >Pendientes</label>
	 	</li>
	 	<li class="g-button g-button-white " id="vistasSolicitudesAceptadas">
	 		<label for="">Aceptadas</label>
	 	</li >
	 	<li class="g-button g-button-white " id="abcUsuarios">
	 		<label for="">Usuarios</label>
	 	</li >
	 	<li class="g-button g-button-white " id="abcAreas">
	 		<label for="">Areas</label>
	 	</li >
	 </ul>
	</div>

	<div class="clear">&nbsp;</div>
</div>
<div id="page-heading"></div>
<!-- ************************************************************************************************************************* -->
<div id="content">
         	        <div id="content-table-inner">
					       <div id="carrito">
										
					       </div>
						  <div class="clear">&nbsp;</div>       
		      		</div>
</div>

<div id="footer">
	<div id="footer-left">
	<div class="clear">&nbsp;</div>
</div>
</body>
</html>