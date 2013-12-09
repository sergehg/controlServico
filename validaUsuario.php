<?php
/**
* 
*/

     include("Session.php");
     Session::init();
     include("conecta.php");

     $name_user=$_REQUEST['usuario'];
     $name_clave=$_REQUEST['clave'];

     //$conexion=conectarMYSQLi($name_user,$name_clave);
     $conexion=conectarMYSQL($name_user,$name_clave);
    
      if(!$conexion){  
            echo "rejected";
        }
    //        else{
    //         $query="SELECT * FROM usuario WHERE usuario='$name_user' and password='$name_clave'";
    //         $rs=mysqli_query($conexion,$query);
    //         if ($rs) {
    //             $row=mysqli_fetch_assoc($rs);
                
    //             Session::set('autenticado', true);
    //             Session::set('level', $row['permiso_tipo'] ); //que nivel tiene (admin, usuario)
    //             Session::set('usuario', $row['nombre'] );
    //             Session::set('id_usuario', $row['id'] ); /// esto es solo de ejemplo , SE TIENE QUE QUITAR EL NUMERO Y OBTENERLO DE LA BASE DE DATOS    
    //             Session::set('user' , $name_user );
    //             Session::set('password' , $name_clave );
    //             //Session::set('tiempo', time());    
    //             echo 'success';

    //         }else{
    //             echo 'rejected';
    //         }

    //      }
   
    // mysqli_close($conexion);

    else{
            $query="SELECT * FROM usuario WHERE usuario='$name_user' and password='$name_clave'";
            $rs=mysql_query($query , $conexion);
            if ($rs) {
                $row=mysql_fetch_assoc($rs);
                
                Session::set('autenticado', true);
                Session::set('level', $row['permiso_tipo'] ); //que nivel tiene (admin, usuario)
                Session::set('usuario', $row['nombre'] );
                Session::set('id_usuario', $row['id'] ); /// esto es solo de ejemplo , SE TIENE QUE QUITAR EL NUMERO Y OBTENERLO DE LA BASE DE DATOS    
                Session::set('user' , $name_user );
                Session::set('password' , $name_clave );
                //Session::set('tiempo', time());    
                echo 'success';

            }else{
                echo 'rejected';
            }

         }
   
    mysql_close($conexion);

  

   //apor el momento solo valida conexion , pero aun falta verificar que pertenece a la aplicacion
?>
