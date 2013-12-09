<?php 

include('Session.php');
Session::init();
include('conecta.php');
   
  $opcion="";
  $idSol="";
  $id=Session::get('id_usuario');
  $user=Session::get('user');
  $pass=Session::get('password');
 $result='';
  if (isset($_REQUEST['opcion']) && !empty($_REQUEST['opcion'])) {
  	 $opcion=$_REQUEST['opcion'];	# code...
  	 $opcion = trim($opcion);
  }

  $con = conectaADO($user,$pass);
  $con ->SetFetchMode(ADODB_FETCH_ASSOC);
  $con->BeginTrans(); 
			  
              $ok;
              $query="";
			  if (0 ==   strcasecmp("ALTA", "$opcion")) {
			  	$datos= $_REQUEST['datos'];
			  	$fecha = new DateTime();
				$fecha->format('Y-m-d H:i:sP') ;
				
				$datos['descripcion']=utf8_decode($datos['descripcion']);
                $datos['titulo']=utf8_decode($datos['titulo']);

			  	$datos['fecha_origen']= $fecha;
				$datos['edo_sol_id']=0;
				$datos['usuario_id']=$id;
			  	$sql = "SELECT * FROM solicitud WHERE id = -1"; 
			    $rs = $con->Execute($sql); # Ejecuta la busqueda y obtiene el recordset vacio
			  	$query=$con->GetInsertSQL($rs, $datos);
	            
			  }elseif (0 ==   strcasecmp("EDITAR", "$opcion")) {
			  	$datos= $_REQUEST['datos'];

			  	$datos['descripcion']=utf8_decode($datos['descripcion']);
                $datos['titulo']=utf8_decode($datos['titulo']);
                
			  	$idSol=$_REQUEST['id_sol'];
			  	$sql = "SELECT * FROM solicitud WHERE id = $idSol   ";  //and id_user=id
			  	$rs = $con->Execute($sql);
			  	$query=$con->GetUpdateSQL($rs, $datos);
			  }elseif (0 ==   strcasecmp("ELIMINAR", "$opcion")) {
			  	$idSol=$_REQUEST['id_sol'];
			  	$query="DELETE FROM solicitud WHERE id= $idSol and usuario_id=$id and edo_sol_id=0";
			  }elseif(0 ==   strcasecmp("SOLICITAR", "$opcion")){
			  	//SE DESEA CONFIRMAR SOLICITUD PARA QUE SEA VISIBLE PARA EL ADMINISTRADOR
			  	$idSol=$_REQUEST['id_sol'];
			  	$fecha = new DateTime();
				$fecha=$fecha->format('Y-m-d H:i:sP') ;

			  	$query="UPDATE solicitud SET edo_sol_id=1 , fecha_solicitada='".$fecha."' WHERE id=$idSol AND usuario_id=$id ";
			  	
			  }
			 
			  	//exit();
			  $ok = $con->Execute("$query"); 

  if ($ok){
  	$con->CommitTrans(); 
  	$result = 'success';
  } 
  else {
  	$con->RollbackTrans(); 
  	$result = 'not success';
  } 
 
  $con->Close();

  echo $result;



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
