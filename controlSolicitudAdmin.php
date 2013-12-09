<?php
    
    include_once('Session.php');
   if(!isset($_SESSION)){ 
        Session::init();
    }  
    include_once('conecta.php');
    $edo=1; //simulando  QUE ELIGIERON LA OPCION  POR DEFAULT
    if ( isset($_REQUEST['estado']) && !empty($_REQUEST['estado'])) {
      $edo=$_REQUEST['estado'] ; # code...
    }

?>
 <form id="carrito" >       
            <table  width="100%" cellpadding="0" cellspacing="0" id="tablaCarrito" style="width:100%;">
                <tr class="tituloTabla">
                    <th class="cabeza" colspan="8">
                         <?PHP 
                         if ($edo==1) {
                             echo "<h1>Solicitudes Por Aceptar o Rechazar</h1>" ;
                         }elseif($edo==2){
                             echo "<h1>Solicitudes Aceptadas</h1> " ;
                             echo "<input type='button' title='reporte'  style ='float:right' id='reporte' value=''/>";
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
                    <th>Descripcion</th>

                    <?php if ($edo==1): ?>
                        <th colspan="3">Opcion</th>    
                    <?php endif ?>

                    <?php if ($edo==2): ?>
                        <th colspan="2">Opcion</th>    
                    <?php endif ?>
                </tr>
                
                <?php 
                
                $id=Session::get('id_usuario'); //Session es importada desde el index;
                $user=Session::get('user');
                $pass=Session::get('password');

                $con = conectaADO($user,$pass);
                $con ->SetFetchMode(ADODB_FETCH_ASSOC); 
                
                $query=" SELECT S.id , E.estado , T.nombre as 'tipo' ,S.edo_sol_id , S.fecha_origen , S.fecha_solicitada ,S.fecha_autorizada , S.titulo , S.descripcion FROM solicitud S
INNER JOIN edo_sol E on E.id=S.edo_sol_id
INNER JOIN tipo T ON T.id=S.tipo
 where S.edo_sol_id=$edo  ";

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
                        echo '<td>'.$row['descripcion'] .'</td>';

                     if ($edo==1) {
                         
                        echo '<td class="aceptarElemBorrador">';
                            echo '<input type ="hidden" name="identificador" value='.$row['id'].' />';

                            echo '<a title="ACEPTAR" href="#">';
                            echo '<img src="images/iconosChicos/ok.gif" width="35" height="35" />';
                            echo '</a>';
                        echo '</td>';

                    
                        echo '<td class="rechazarElemBorrador">';
                            echo '<input type ="hidden" name="identificador"  value='.$row['id'].' />';

                            echo '<a title="RECHAZAR" href="#">';
                            echo '<img src="images/iconosChicos/eliminar.gif" width="35" height="35" />';
                            echo '</a>';
                        echo '</td>';


                        echo '<td class="detalleElemBorrador">';
                            echo '<input type ="hidden" name="identificador"  value='.$row['id'].' />';
                            echo '<a title="DETALLE" href="#">';
                            echo '<img src="images/iconosJunior/lampara.ico" width="35" height="35" />';
                            echo '</a>';
                        echo '</td>';

                     }
                     if ($edo==2) {

                         echo '<td class="PDFElemBorrador">';
                            echo '<input type ="hidden" name="identificador" value='.$row['id'].' />';
    
                            echo '<a title="PDF" target="_blank" href="MiPDF.php?id_sol='.$row['id'].'">';
                            echo '<img src="images/iconosChicos/pdf.gif" width="35" height="35" />';
                            echo '</a>';
                        echo '</td>';
                                          

                        echo '<td class="detalleElemBorrador">';
                            echo '<input type ="hidden" name="identificador"  value='.$row['id'].' />';
                            echo '<a title="DETALLE" href="#">';
                            echo '<img src="images/iconosJunior/lampara.ico" width="35" height="35" />';
                            echo '</a>';
                        echo '</td>';
                     }

                        echo '</tr>';

                }
                $con -> Close();
                ?>
             </table>
    </form>
