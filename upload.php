<?php 
include_once('Session.php');

if(!isset($_SESSION)){ 
  Session::init();
    if(!Session::get('autenticado')){
    	header('Location: login.php'); 
		exit();
	}
} 
$status = "";

$id_sol=$_REQUEST['id_sol'];


$estructura ="";
if($id_sol) $estructura= 'files/'.$id_sol.'/';

if (isset($_REQUEST["action"])) 
{

	if ($_REQUEST["action"] == "upload" && !empty($id_sol) && isset($id_sol) ) {
		// obtenemos los datos del archivo 
		$tamano = $_FILES["archivo"]['size'];
		$tipo = $_FILES["archivo"]['type'];
		$archivo = $_FILES["archivo"]['name'];
		$prefijo = substr(md5(uniqid(rand())),0,6);
		$carpeta=$id_sol;
		if ($archivo != "") {
			// guardamos el archivo a la carpeta files
			$estructura = 'files/'.$carpeta.'/';       
			if (!file_exists($estructura)) {
			    if(!mkdir($estructura, 0, true)){
			  	  die('Fallo al crear carpetas...');
				}
			} 
			$destino =  "files/".$carpeta."/".$prefijo."_".$archivo;
			if (copy($_FILES['archivo']['tmp_name'],$destino)) {
				$status = "Archivo anexado correctamente";
			} else {
				$status = "Error al subir el archivo";
			}
		} else {
			$status = "Error al subir archivo";
		}
	}
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FILES</title>
<link href="estilo.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="413" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
    <td class="text">Por favor seleccione el archivo a subir:</td>
  </tr>
  <tr>
  <form action="upload.php" method="post" enctype="multipart/form-data">
    <td class="text">
      <input name="archivo" type="file" class="casilla" id="archivo" size="35" />
      <input name="enviar" type="submit" class="boton" id="enviar" value="Upload File" />
	  <input name="action" type="hidden" value="upload" />
	  <input name="id_sol" type="hidden" value="<?=$id_sol?>" />
	  	  </td>
	</form>
  </tr>
  <tr>
    <td class="text" style="color:#990000"><?php echo $status; ?></td>
  </tr>
  <tr>
    <td height="30" class="subtitulo">Listado de Archivos Asociados </td>
  </tr>
  <tr>
    <td class="infsub">
	<?php 
	// if ($gestor = opendir('files')) { //en ves de files deberia ser $estructura
	// 	echo "<ul>";
	//     while (false !== ($arch = readdir($gestor))) {
	// 	   if ($arch != "." && $arch != "..") {
	// 		   echo "<li><a href=\"files/".$arch."\" class=\"linkli\">".$arch."</a></li>\n";
	// 	   }
	//     }
	//     closedir($gestor);
	// 	echo "</ul>";
	// }
	?>	
</td>
<tr>
	<td class="infsub">
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
	</td>
</tr>
  </tr>
</table>
</body>
</html>
