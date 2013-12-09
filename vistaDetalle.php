<?php 
   include_once('Session.php');

   if(!isset($_SESSION)){ 
        Session::init();
        if(!Session::get('autenticado')){
   			header('Location: login.php'); 
			exit();
		}
    } 
    include_once('conecta.php'); 
?>



<style type="text/css">
#formVisaDetalle{
	background-color: #ffffff;
	clear: both;
	overflow: hidden;
	width: 90%;
	margin: 0 auto;
	}
form#formVisaDetalle ul li{
  list-style: none;
  list-style-image:none;
  margin:0;
  padding:0;
	}

form#formVisaDetalle ul li input,
form#formVisaDetalle textarea,
form#formVisaDetalle select {
  padding: 4px;
  font: 400 1em Verdana, Sans-serif;
  color: #444;
  background:#ffffff;
  border: 1px solid #999;
  margin:2px;
	}

form#formVisaDetalle ul li input:focus,
form#formVisaDetalle textarea:focus,
form#formVisaDetalle ul li select:focus {
  color: #000;
  border: 1px solid #329BCE;
	}

form#formVisaDetalle ul li label {
  font-weight:bold;
  display: inline-block;
  vertical-align:top;
  width:115px;
	}
form#formVisaDetalle ul li textarea , form#formVisaDetalle ul li input{
  width:300px;
	}
.cabezaTitulo{
  position: absolute;
  top: -28px;
  width: 90%;
  text-align: center;
  background-color: #EFF0F0;
	}
.opcionesVistaDetalle{
     float:left;
     margin-right:-6px;
     margin-left:-6px;
     margin-top: -15px;
	}

.btCerrarDetalle{
	 position: absolute;
	 width:30px;	
	 height: 30px;
	 background: #F0F0F0 url('images/iconosChicos/cerrar_cuadradoGray.png') no-repeat;
	 background-size: 100% 100%;

	 left: -34px;
	 border: none;
	 cursor: pointer;
	}
.btCerrarDetalle:hover{
	 width:30px;	
	 height: 30px;
	 background: #F0F0F0 url('images/iconosChicos/cerrar_cuadradoGraylighter.png') no-repeat;
	 background-size: 100% 100%;

	 cursor: pointer;
	}
ul {
	list-style: none;
	}
.vdDatosPrincipales{
	float: left;
	}

.vdDatosFecha{
	float: left;
	}
.vdDatosFecha label {
	margin: 4px 0;
}	
.vdArchivo{
	clear: both;
	
	}


.subtitulo {
	font-family: "Trebuchet MS", Verdana;
	font-size: 16px;
	font-weight: bolder;
	color: #999999;
	text-decoration: none;

	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #D4D0C8
	}

.lista{
	list-style-type: circle;
	font-size: 16px;
	text-decoration: none;
	}
.linkli {
	font-family: "Trebuchet MS", Verdana;
	font-size: 12px;
	font-weight: normal;
	color: #0000C0;
	text-decoration: none;
	}
a.linkli:hover {
	font-family: "Trebuchet MS", Verdana;
	font-size: 12px;
	font-weight: normal;
	color: #0000C0;
	text-decoration: underline;
	}

.subirArchivos{
	height: 20%;
	}
.cursor{
	cursor: pointer;
	}


</style>





 <?php if (isset($_REQUEST['id_sol'])) :
 	
 	$id_sol=$_REQUEST['id_sol'];
 	$estructura = 'files/'.$id_sol.'/';
	$idUser=Session::get('id_usuario');
	$user=Session::get('user');
	$pass=Session::get('password'); 

    $con = conectaADO($user,$pass);
    $con ->SetFetchMode(ADODB_FETCH_ASSOC); 

$query= "SELECT F.id as 'folio' , U.nombre as 'usuario', A.nombre as 'area' , S.titulo , S.descripcion , T.nombre as 'tipo',  E.estado , S.edo_sol_id , S.fecha_origen , S.fecha_solicitada ,S.fecha_autorizada , S.fecha_rechazada , S.fecha_confirmada  FROM solicitud S
INNER JOIN edo_sol E on E.id=S.edo_sol_id
INNER JOIN tipo T ON T.id=S.tipo
INNER JOIN usuario U  ON U.id=S.usuario_id 
INNER JOIN area A ON A.id=U.area_id
LEFT JOIN folio F ON F.solicitud_id=S.id 
WHERE S.id=$id_sol";

    $rsSolicitud =  $con->Execute($query);
    $rsSolicitud =  $rsSolicitud->FetchRow();

   // $rsAdjunto= $con->Execute("SELECT * from archivo WHERE solicitud_id=$id_sol");
    //$rsAdjunto=$rsAdjunto->FetchRow();

?>
 	
<form action="" id="formVisaDetalle">

	<div class="cabezaTitulo">
		 <input type="button" value="" id="cerrarDetalle" class="btCerrarDetalle">
	     <span>
	          Vista Detalle
	     </span><br>
	     <div class="opcionesVistaDetalle">
	         <?php  //echo "<input type='button' id='unID' value='aceptar' class='g-button g-button-white'/> ";
	                echo "</br>";
	                echo "</br>";
	          ?> 
	     </div>
    </div>
	<ul name="datosPrincipales" class="vdDatosPrincipales" >
		<li>
			<label for="" >
				Folio
			</label>
			<label for="" name="datos['folio']">
				<?= $rsSolicitud['folio'] ?>
			</label>
		</li>

		<li>
			<label for="">Tipo</label> 		
	 			<?php  
                 $con = conectaADO($user,$pass);
                 $con ->SetFetchMode(ADODB_FETCH_ASSOC); 
                 $query = "select * from tipo";
                 $rs = $con->Execute($query); 
              
             ?>
            <select  class="styledselect" id="datos[tipo]" name="datos[tipo]">
                <?
                    foreach ($rs as $row) {
                        $MiSelected = "" ;
                        if( 0 ==   strcasecmp("EDITAR", "$opcion") )
                            $MiSelected = ( $row[id] == $rsSolicitud[tipo]  )? "selected" : ""; 
                        echo "<option value='".$row['id']."'  $MiSelected  >".$row['nombre']." </option>";
                    }
                ?>
            <select  class="styledselect" id="datos[tipo]" name="datos[tipo]">

		</li>

		<li>
			<label for="">Titulo</label> <input type="text" name="datos[titulo]" value=" <?= $rsSolicitud['titulo'] ?>    ">
		</li>

		

		<li>
			<label for="">
				Descripci&oacuten
			</label>
			 <textarea name="datos[descripcion]" id="descripcion" cols="30" rows="7"> <?= $rsSolicitud['descripcion'] ?></textarea> 
		</li>

		<li>
			<label for="">
				Solicitado por :
			</label>
			
				<?= $rsSolicitud['usuario'] ?>
			
		</li>

		<li>
			<label for="">
				Area :
			</label>
			
				<?= $rsSolicitud['area'] ?>
			
		</li>

		<li>
			<label for="">
				Estado :
			</label>
			
				<?= $rsSolicitud['estado'] ?>
			
		</li>

	</ul>							

	<ul name="datosFecha" class="vdDatosFecha">
		<li>
			<label for="">Fecha Creaci&oacuten :</label><label for=""><?= "  ".$rsSolicitud['fecha_origen'] ?></label>
		</li>
		<li>
			<label for="">Fecha Solicitada :</label><label for=""><?= "  ".$rsSolicitud['fecha_solicitada'] ?></label>
		</li>
		<li>
			<label for="">Fecha Autorizada :</label><label for=""><?= "  ".$rsSolicitud['fecha_autorizada'] ?></label>
		</li>
		<li>
			<label for="">Fecha Rechazada :</label><label for=""><?= "  ".$rsSolicitud['fecha_rechazada'] ?></label>
		</li>
		<li>
			<label for="">Fecha Confirmada :</label><label for=""><?= "  ".$rsSolicitud['fecha_confirmada'] ?></label>
		</li>

	</ul>
	<ul name="vdArchivo" class="vdArchivo">
		<li>			
				<a class="cursor"  onclick =" abrir_ventana('upload.php' , <?=$id_sol?>); ">
					<img title="adjuntar" src="images/iconosJunior/archivos.ico" width="35" height="35" />
				</a>
			    <label for="" class="subtitulo cursor"  onclick =" abrir_ventana('upload.php' , <?=$id_sol?>); ">Listado de Archivos Asociados</label>
		</li>	
		<li>
			<?php 
			$ruta="$estructura";
			// if ($rsAdjunto) {
			// 	$ruta=$rsAdjunto['directorio'] . "/" . $rsAdjunto['solicitud_id'];
			// }

			if (file_exists($estructura)) {
				if ($gestor = opendir($ruta)) { //en ves de files deberia ser $estructura
					echo "<ul>";
				    while (false !== ($arch = readdir($gestor))) {
					   if ($arch != "." && $arch != "..") {
						   echo "<li class='lista'><a target='_blank' href=\"$estructura".$arch."\" class=\"linkli\">".$arch."</a></li>\n";
					   }
				    }
				    closedir($gestor);
					echo "</ul>";
				}
			}
			?>
		</li>	
	
	</ul>

</form>


<script language="javascript"> 
<!-- 
function abrir_ventana(url,id) 
{ 
	propiedades="width=600, height=800 , scrollbars=1 , resizable=YES , menubar=1  "; 
	window.open(url+"?id_sol="+id,"_blank",propiedades); 
} 
//--> 
</script> 


<?php endif ?>


	

