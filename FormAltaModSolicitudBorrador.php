<?PHP 
      require_once('Session.php');
      Session::init();
      require_once('conecta.php');
      $opcion="";
      $idSol="";
      $idAction="agregarAlBorrador";// Es para controlar la acction del boton submit
      if (isset($_REQUEST['opcion'])) {
        $opcion=$_REQUEST['opcion'];
      }
      if (isset($_REQUEST['idSolicitud'])) {
        $idSol=$_REQUEST['idSolicitud'];
      }

      $actionID="";
      $tituloSol="";

      $tipoSol="";
      $rsSolicitud="";

      $idUser=Session::get('id_usuario');
      $user=Session::get('user');
      $pass=Session::get('password');

              $con = conectaADO($user,$pass);
              $con ->SetFetchMode(ADODB_FETCH_ASSOC); 

      if ( $opcion &&  !empty( $opcion ) ) {
          $opcion = trim($opcion);
          if ( 0 ==   strcasecmp("Editar", "$opcion")) {
              $con = conectaADO($user,$pass);
              $con ->SetFetchMode(ADODB_FETCH_ASSOC); 
              $query=("SELECT tipo  , titulo , descripcion FROM solicitud WHERE id=$idSol and usuario_id=$idUser");
              $rsSolicitud =  $con->Execute($query);
              $rsSolicitud =  $rsSolicitud->FetchRow();
              $idAction="editar";
          }
      }else{
          $opcion="ALTA";
      }
?>       
<style type="text/css">

form#AltaMod{
  background-color: #ffffff;
  padding: 10px 0px;
  width: 60%;
  margin: 0 auto;
  }
form#AltaMod ul li{
  list-style: none;
  list-style-image:none;
  margin:0;
  padding:0;
  }

form#AltaMod ul li input,
form#AltaMod textarea,
form#AltaMod select {
  padding: 4px;
  font: 400 1em Verdana, Sans-serif;
  color: #444;
  background:#ffffff;
  border: 1px solid #999;
  margin:2px;
  }

form#AltaMod ul li input:focus,
form#AltaMod textarea:focus,
form#AltaMod ul li select:focus {
  color: #000;
  border: 1px solid #329BCE;
  }

form#AltaMod ul li label {
  font-weight:bold;
  display: inline-block;
  padding-top:8px;
  vertical-align:top;
  width:100px;
  }
form#AltaMod ul li textarea , form#AltaMod ul li input{
  width:300px;
  }

.cabezaTitulo{
  position: absolute;
  top: -28px;
  width: 60%;
  text-align: center;
  background-color: #EFF0F0;
}
.agregar{
 float:left;
 margin-right:-6px;
 margin-left:-6px;
 margin-top: -15px;
  }

.btCancelar{
 position: absolute;
 border: none;
 color : #000;
 width:30px;  
 height: 30px;
 background: #F0F0F0 url('images/iconosChicos/cerrar_cuadradoGraylight.png') no-repeat;
 background-size: 100% 100%;
 left: -34px;
 border: none;
 cursor: pointer;
  }

.btCancelar:hover{
 border: none;
 color : #000;
 margin: 0px;
 background: #F0F0F0 url('images/iconosChicos/cerrar_cuadradoGraylighter.png') no-repeat;
 background-size: 100% 100%;
 border: none;
 cursor: pointer;
  }

.imageConcepto{
  float: right;
  margin-right: 100px;
  }

.imageConcepto  img{
  width: 150px;
  height: 150px;
  }
</style>

<link rel="stylesheet" type="text/css" href="css/jquery.validity.css" />

        <form id="AltaMod" > 
            <div>
              
              <div class="cabezaTitulo">
                <input type='button' id='cancelarForm' value='' class="btCancelar"/>
                 <span>
                      <?= "". $opcion. ""?>
                 </span><br>
                 <div class="agregar">
                     <?php  echo "<input type='button' id='". $idAction . "' value='aceptar' class='g-button g-button-white'/> ";
                            echo "</br>";
                      ?> 
                 </div>
              </div>
          
              <ul>
                  <li>
                    <label>Tipo :</label>
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
                    <label>Titulo :</label>
                      <?php  if( 0 ==   strcasecmp("ALTA", "$opcion") ):?>
                        <input type="text" name="datos[titulo]" maxlength="30" id="tituloSolicitudFORM">
                      <?php endif; ?>

                      <?php  if( 0 ==   strcasecmp("EDITAR", "$opcion") ) :?>
                        <input type="text" name="datos[titulo]" maxlength="30" value=" <?= $rsSolicitud['titulo'] ?>" id="tituloSolicitudFORM">
                      <?php endif; ?>
                  </li>
                  <li>
                    <label>Descripci&oacuten</label>
                      <?php  if( 0 ==   strcasecmp("ALTA", "$opcion") ):?>
                        <textarea name="datos[descripcion]" id="descripcion" cols="30" rows="7" ></textarea> 
                      <?php endif; ?>

                      <?php  if( 0 ==   strcasecmp("EDITAR", "$opcion") ) :?>
                        <textarea name="datos[descripcion]" id="descripcion" cols="30" rows="7" > <?= $rsSolicitud['descripcion'] ?></textarea> 
                      <?php endif; ?>
                  </li>
              </ul>

             
              <?php  if( 0 ==   strcasecmp("EDITAR", "$opcion") ) :?>
                      <input type="hidden" name="id_sol" value="<?= $idSol ?>" />
              <?php endif; ?>
            </div>      
        </form>
  