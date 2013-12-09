<?php
    include_once('Session.php');
   if(!isset($_SESSION)){ 
        Session::init();
    }  
    include_once('conecta.php');
    $edo=0; //simulando  QUE ELIGIERON LA OPCION 0 QUE ES LA INACTIVA POR DEFAULT
    if ( isset($_REQUEST['estado']) && !empty($_REQUEST['estado'])) {
      $edo=$_REQUEST['estado'] ; # code...
    }
?>
 <form id="carrito" >       
            <table  width="100%" cellpadding="0" cellspacing="0" id="tablaCarrito" style="width:100%;">
                <tr class="tituloTabla">
                    <th class="cabeza" colspan="9">
                         <?PHP 
                         if ($edo==0) {
                             echo "<h1>Solicitudes Inactivas </h1>" ;
                         }else{
                             echo "<h1>Solicitudes Enviadas</h1>" ;
                         }
                            
                         ?>
                    </th>
                    
                </tr>
                <tr class="encabezado">
                    <th>Estado</th>
                    <th>Tipo</th>

                    <?php if ($edo==0): ?>
                        <th>Fecha Creada</th>    
                    <?php endif ?>
                    <?php if ($edo==1): ?>
                        <th>Fecha Solicitada</th>    
                    <?php endif ?>
                    <?php if ($edo==2): ?>
                        <th>Fecha Aceptada</th>
                    <?php endif ?>
                   

                    <th>Titulo</th>
                    <th>Descripci&oacuten</th>
                    <?php if ($edo==0): ?>
                        <th colspan="4">Opci&oacuten</th>    
                    <?php endif ?>

                    <?php if ($edo==-2): ?>
                        <th colspan="1">Opci&oacuten</th>    
                    <?php endif ?>
                    
                </tr>
                
                <?php 
                
                $id=Session::get('id_usuario'); //Session es importada desde el index;
                $user=Session::get('user');
                $pass=Session::get('password');

                $con = conectaADO($user,$pass);
                $con ->SetFetchMode(ADODB_FETCH_ASSOC); 
                
                if ($edo==-2) {
                    $query=" SELECT S.id, E.estado , T.nombre as 'tipo' ,S.edo_sol_id , S.fecha_origen , S.fecha_solicitada ,S.fecha_autorizada , S.titulo , S.descripcion 
                                    FROM solicitud S
                                        INNER JOIN edo_sol E on E.id=S.edo_sol_id
                                        INNER JOIN tipo T ON T.id=S.Tipo WHERE usuario_id = $id AND edo_sol_id != 0 ";
                }else
                    $query=" SELECT S.id,  E.estado , T.nombre as 'tipo' ,S.edo_sol_id , S.fecha_origen , S.fecha_solicitada ,S.fecha_autorizada , S.titulo , S.descripcion 
                                    FROM solicitud S
                                        INNER JOIN edo_sol E on E.id=S.edo_sol_id
                                        INNER JOIN tipo T ON T.id=S.Tipo where S.usuario_id = $id and S.edo_sol_id=$edo ";

                $rs = $con -> Execute($query);

                foreach ($rs as $key => $row){
                        echo '<tr class="elementoBorrador">';
                                           
                        echo '<td>'.$row['estado'].'</td>';
                        echo '<td>'.$row['tipo'] .'</td>';

                        if ($edo==0) {
                        echo "<td>".$row['fecha_origen'].'</td>';
                        }
                        if ($edo==1) {
                        echo "<td>".$row['fecha_solicitada'].'</td>';
                        }
                        if ($edo==2) {
                        echo "<td>".$row['fecha_autorizada'].'</td>';
                        }

                        echo '<td>'.$row['titulo'] .'</td>';
                        echo '<td style="table-layout:fixed; overflow:hidden;">'.$row['descripcion'] .'</td>';
                      
                        if ($edo==-2) {
                            echo '<td class="detalleElemBorrador">';
                                echo '<input type ="hidden" name="identificador"  value='.$row['id'].' />';
                                echo '<a title="DETALLE" href="#">';
                                echo '<img src="images/iconosJunior/lampara.ico" width="35" height="35" />';
                                echo '</a>';
                            echo '</td>';
                        }

                     if ($edo==0) {
                         
                        echo '<td class="editarElemBorrador">';
                            echo '<input type ="hidden" name="identificador" value='.$row['id'].' />';

                            echo '<a title="EDITAR" href="#">';
                            echo '<img src="images/iconosChicos/edit.png" width="35" height="35" />';
                            echo '</a>';
                        echo '</td>';

                    
                        echo '<td class="eliminarElemBorrador">';
                            echo '<input type ="hidden" name="identificador"  value='.$row['id'].' />';

                            echo '<a title="ELIMINAR" href="#">';
                            echo '<img src="images/iconosChicos/eliminar.gif" width="35" height="35" />';
                            echo '</a>';
                        echo '</td>';


                        echo '<td class="enviarElemBorrador">';
                            echo '<input type ="hidden" name="identificador"  value='.$row['id'].' />';
                            echo '<a title="ENVIAR (Confirmar) " href="#">';
                            echo '<img src="images/iconosChicos/correo.gif" width="35" height="35" />';
                            echo '</a>';
                        echo '</td>';

                        echo '<td class="detalleElemBorrador">';
                            echo '<input type ="hidden" name="identificador"  value='.$row['id'].' />';
                            echo '<a title="DETALLE" href="#">';
                            echo '<img src="images/iconosJunior/lampara.ico" width="35" height="35" />';
                            echo '</a>';
                        echo '</td>';


                     } //fin si estado es igual a 0
                     
                       


                        echo '</tr>';

                }
                $con -> Close();
                ?>
                </table>
    </form>
