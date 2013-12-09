  <?php
    include_once('adodb5/adodb.inc.php');
	include("adodb5/adodb-exceptions.inc.php");//para mostrar errores

	function conectaADO_to_this($host,$user,$pwd,$db,$tipo){
		 $DB = NewADOConnection($tipo);
		 $DB->Connect($host, $user, $pwd,$db);
 		 return $DB;
	}

   function conectaADO($user,$pwd){
		 $DB = NewADOConnection("mysql");
		 $DB ->Connect("localhost", $user, $pwd,"controlservice");
 		 return $DB;
	} 

	function conectarMYSQL($usuario,$clave){
	
		$conexion=mysql_connect("localhost",$usuario,$clave);
		try{
			mysql_select_db("controlservice",$conexion);
		}catch(Exception $e ) {

		}
		return $conexion;
	}

	function conectarMYSQLi($usuario,$clave){
		$conexion = mysqli_connect("localhost", $usuario, $clave, "controlservice");
		if (mysqli_connect_errno()) {
    		
		}
		return $conexion;
	}
?>