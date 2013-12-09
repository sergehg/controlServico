<?php 
  include_once('Session.php');
  if(!isset($_SESSION)){ 
        Session::init();
    }  
  include_once('conecta.php');
   
  $opcion="";
  $idSol="";
  $response='';
  $id=Session::get('id_usuario');
  $user=Session::get('user');
  $pass=Session::get('password');

  if (isset($_REQUEST['opcion']) && !empty($_REQUEST['opcion'])) {
  	 $opcion=$_REQUEST['opcion'];	# code...
  	 $opcion = trim($opcion);
  }

  $con = conectaADO($user,$pass);
  $con ->SetFetchMode(ADODB_FETCH_ASSOC);
  $con->BeginTrans(); 
			  
              $ok;
              $query="";
                
			  if (0 ==  strcasecmp("ACEPTAR", "$opcion") ) {
			  	
			  	$datos= array();
			  	$idSol=$_REQUEST['id_sol'];

			  	$fecha = new DateTime();
				$fecha = $fecha->format('Y-m-d H:i:sP') ;
                    
			  	$datos['fecha']= $fecha;
				$datos['solicitud_id']=$idSol;
				$datos['usuario_id']=$id;

			  	$sql = "SELECT * FROM folio WHERE id = -1"; 
			    $rs = $con->Execute($sql); # Ejecuta la busqueda y obtiene el recordset vacio
			  	$query=$con->GetInsertSQL($rs, $datos);
			  	
			  	$ok = $con->Execute($query); 

			  	if ($ok) {
			  		
			  		$fecha = new DateTime();
					$fecha = $fecha->format('Y-m-d H:i:sP') ;

			  		$idSol=$_REQUEST['id_sol'];
			   		$query="UPDATE solicitud SET edo_sol_id=2 , fecha_autorizada='".$fecha."' WHERE id=$idSol ";
			  		$ok = $con->Execute($query); 

			  	}
	            
			  }elseif (0 ==   strcasecmp("RECHAZAR", "$opcion")) {
			  	  $fecha = new DateTime();
				  $fecha = $fecha->format('Y-m-d H:i:sP') ;

			  	  $idSol=$_REQUEST['id_sol'];
			  	  $query="UPDATE solicitud SET edo_sol_id=-1 , fecha_rechazada='".$fecha."' WHERE id=$idSol ";
			  	  $ok = $con->Execute($query);
			  	  
			  }
			
			  

  if ($ok){
  	$con->CommitTrans(); 
  	$response = 'success';
  } 
  else {
  	$con->RollbackTrans(); 
  	$response =  'not success';
  } 
 
  $con->Close();
  echo $response;



  //$con->AutoExecute('solicitud',$datos,'INSERT');

/*

$sql = "SELECT * FROM solicitud WHERE id = -1"; 
					$rs = $con->Execute($sql); # Ejecuta la busqueda y obtiene el recordset vacio
					$insertSQL=$con->GetInsertSQL($rs, $datos);
					
					$con->Execute($insertSQL);
 $conexion=conectarMYSQL($user, $pass);

 if ($conexion) {
 	$fecha= date("Y-m-d"); 

	$tipoSolicitud=$_REQUEST[datos['tipoSolicitud']];
	$titulo=$_REQUEST[datos['titulo']];
	$descripcion=$_REQUEST[datos['descripcion']];

	$id_usuario= Session::get('id_usuario');

 	$query = "
	INSERT INTO `controlservice`.`solicitud` (
	`id` ,
	`tipo` ,
	`titulo` ,
	`fecha_origen` ,
	`descripcion` ,
	`fecha_solicitada` ,
	`fecha_revisada` ,
	`fecha_autorizada` ,
	`fecha_confirmada` ,
	`fecha_rechazada` ,
	`fecha_cancelada` ,
	`edo_sol_id` ,
	`usuario_id`
	)
	VALUES (
	NULL , '".$tipoSolicitud."' , '".$titulo."' , '".$fecha."' , '".$descripcion."' , NULL , NULL , NULL , NULL , NULL , NULL , '0', '".$id_usuario."');
 	";

 	mysql_query($query);
 }*/

?>
<?php  
//select de solictud aceptada , falta saber quien la acepto
/*SELECT U.nombre AS 'usuario', A.nombre AS 'area', SU.nombre AS 'sucursal' , T.nombre AS 'Tipo Solicitud' ,S.titulo AS 'titulo' , S.descripcion AS 'Descripcion' ,S.id, S.fecha_solicitada , F.fecha AS 'fecha Autorizada' ,F.id AS 'folio'
 FROM 
	folio F
	INNER JOIN solicitud S ON S.id=F.solicitud_id 
	INNER JOIN tipo T ON T.id=S.tipo
	INNER JOIN usuario U ON U.id=S.usuario_id
	INNER JOIN controlservice.area A ON A.id=U.area_id
	INNER JOIN sucursal AS SU ON SU.id=U.sucursal_id*/
?>
