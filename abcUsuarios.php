<?php 
require_once('Session.php');
if(!isset($_SESSION)){
	session_start();
}
require_once('conecta.php');
if (0 !=   strcasecmp("admin", Session::get('level') ))
 {
	header('Location: index.php'); 
   	exit(); 	
 }
 
$idUser=Session::get('id_usuario');
$user=Session::get('user');
$pass=Session::get('password');

/*<form>
	<ul>
		<li><label>Nombre</label></li>
		<li><label>Apellido Paterno</label></li>
		<li><label>Apellido Materno</label></li>
		<li><label>Usuario</label></li>
		<li><label>Email</label></li>
		<li><label>Tipo de permiso</label></li> 
		<li><label>Area</label> </li>
		<li><label>Sucursal</label> </li>
		<li><label>Puesto</label> </li>
	</ul>
	
 </form>*/
 ?>
 <table>
<form>
	<tr>
		<th>
			Usuario 
		</th>

		<th>
			Email
		</th>
		<th>
			Area
		</th>

	</tr>
	<?php 
	$DB	 = conectaADO($user,$pass);
	$DB ->SetFetchMode(ADODB_FETCH_ASSOC); 
	$query="SELECT * FROM usuario";
	$rs = $DB->Execute($query);
	foreach ($rs as $key => $row) {  ?>
	<tr>
		<td>
			<?php echo  $row['usuario'] ?>
		</td>
			
		<td>
			<?php echo $row['email'] ?>
		</td>
			
		<td>
			<?php 
			   	$query="SELECT * from area WHERE id=".$row['area_id']."";
				$rsArea= $DB -> Execute($query);
				$rsArea = $rsArea ->FetchRow();
				echo "". $rsArea['nombre'] ." ";
			 ?>
		</td>
		<input type="hidden" value="<?php echo $row['id'] ?> ">
		
	</tr>	
	
	<?}?>

</form>
 </table>
 
