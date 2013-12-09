$(document).ready(function(e){
            
            $("#table-content").fadeOut();
            $('div.contenedorEmergente').fadeOut();

           $('#cargador').ajaxStart(function(){
                $(this).show();
              }).ajaxStop(function(){
                $(this).hide();
              });

            $("#cancelarForm").live("click",function(){
              $("div.validity-tooltip").remove();
                $("#table-content").fadeOut().promise().done(function(){
                     $("#page-heading").html("<h1>  </h1>");   
                     $('div.contenedorEmergente').fadeOut();
                      $('li.selected').removeClass('selected');
                });
            });

            $("#agregarAlBorrador").live('click',function(e){
                    e.preventDefault();
                     var formulario=$("#AltaMod");
                     var datos=formulario.serialize();

                     $.validity.start();

                     $.validity.setup({ outputMode:"tooltip" ,modalErrorsClickable:true });
                     
                     $("#tituloSolicitudFORM").require("Campo requerido"); 
                     
                     $("#descripcion").require("Campo requerido");

                     datos+="&opcion=ALTA";
                     if ($.validity.end().valid) {
                          // var lista= document.getElementById("idProducto");
                         // var nombreProducto=lista.options[lista.selectedIndex].text;
                        // datos+="&opcion=ALTA";
                        $.ajax({
                                type: "POST",
                                url: "AccionesBorrador.php",
                                data: datos,
                                contentType: "application/x-www-form-urlencoded;charset=UTF-8",
                                success: function(data){
                                    if($.trim(data) == 'success'){
                                          HTML='<h1 class="green-left">Tarea realizada con EXITO</h1>';
                                          aviso(HTML);
                                          
                                          jQuery('#cargador').hide();
                                          console.log('success'+data);
                                        
                                    }else{
                                          HTML='<h1 class="red-left">Problemas al ejecutar</h1>';
                                          aviso(HTML);
                                          jQuery('#cargador').hide();
                                          
                                    }
                                       // setTimeout(location="index.php",500);
                                },
                                error: function(){
                                    jQuery('#cargador').hide();
                                    
                                },
                                timeout: 180000
                        });//fin ajax
                  };//fin if validity
                            
            });//fin agregar

          

            $("#editar").live("click",function(e){
                    $.validity.start();

                    $.validity.setup({ outputMode:"tooltip" ,modalErrorsClickable:true });
                     
                    $("#tituloSolicitudFORM").require("Campo requerido"); 
                     
                    $("#descripcion").require("Campo requerido");
                    
                    if ($.validity.end().valid) {
                      var formulario=$("#AltaMod");
                      var datos=formulario.serialize();
                      datos+="&opcion=EDITAR";

                        // var lista= document.getElementById("idProducto");
                       // var nombreProducto=lista.options[lista.selectedIndex].text;
                      // datos+="&opcion=ALTA";
                      $.ajax({
                              type: "POST",
                              url: "AccionesBorrador.php",
                              data: datos,
                              contentType: "application/x-www-form-urlencoded;charset=UTF-8",
                              success: function(data){
                                   if($.trim(data) == 'success'){
                                        HTML='<h1 class="green-left">Tarea realizada con EXITO</h1>';
                                        aviso(HTML);
                                        jQuery('#cargador').hide();
                                      
                                  }else{
                                        HTML='<h1 class="red-left">Problemas al ejecutar</h1>';
                                        aviso(HTML);
                                        jQuery('#cargador').hide();
                                  }
                              },
                              error: function(){
                                  jQuery('#cargador').hide();
                                  
                              },
                              timeout: 180000
                              
                      });//fin ajax
                    };//fin if validity
            });  //fin editar
         
            $('.eliminarElemBorrador').live("click",function(e){
                    var id=$(this).find('input[type=hidden]').val()
                    
                    var desicion=confirm("realmente desea ELIMINAR el elemento?");

                    if (desicion) {
                        var datos="opcion=ELIMINAR&id_sol="+id;
                          $.ajax({
                            
                            type: "POST",
                            url: "AccionesBorrador.php",
                            data: datos,
                            contentType: "application/x-www-form-urlencoded;charset=UTF-8",
                            success: function(data){
                                if($.trim(data) == 'success'){
                                      HTML='<h1 class="green-left">Tarea realizada con EXITO</h1>';
                                      aviso(HTML);
                                      jQuery('#cargador').hide();
                                }else{
                                      HTML='<h1 class="red-left">Problemas al ejecutar</h1>';
                                      aviso(HTML);
                                      jQuery('#cargador').hide();
                                      
                                }
                                    
                            },
                            error: function(){
                                jQuery('#cargador').hide();
                                
                            },
                            timeout: 180000
                            
                    });
                    }else {
                        
                    };
            });//fin ELIMINAR


            $('.enviarElemBorrador').live("click", function(e){

                    var id=$(this).find('input[type=hidden]').val();
                    var desicion=confirm("Quiere proceder CON ENVIAR ESTA SOLICITUD al corporativo de SISTEMAS?");
                    if (desicion) {
                        var datos="opcion=SOLICITAR&id_sol="+id;
                          $.ajax({

                            type: "POST",
                            url: "AccionesBorrador.php",
                            data: datos,
                            contentType: "application/x-www-form-urlencoded;charset=UTF-8",
                            success: function(data){
                                if($.trim(data) == 'success'){
                                      HTML='<h1 class="green-left">Tarea realizada con EXITO tu solicitud ha sido enviada</h1>';
                                      aviso(HTML);
                                      jQuery('#cargador').hide();
                                }else{
                                      HTML='<h1 class="red-left">Problemas al ejecutar</h1>';
                                      aviso(HTML);
                                      jQuery('#cargador').hide();
                                }
                            },
                            error: function(){
                                   jQuery('#cargador').hide();
                            },
                            timeout: 180000
                            
                          });//FIN AJAX
                    }//FIN SI
                    e.preventDefault();

            });

             $('.editarElemBorrador').live("click",function(e){
                    var id=$(this).find('input[type=hidden]').val();
                    /*alert( "accion EDITAR id= "+id);*/
                    $("#page-heading").html("<h1>Opcion Editar</h1>");
                    $("#table-content").hide().promise().done(function(){
                      $("#table-content").load('FormAltaModSolicitudBorrador.php' , { opcion : 'EDITAR' , idSolicitud : id } ).promise().done(function(){
                         $('div.contenedorEmergente').fadeIn().promise().done(function(e){
                            $("#table-content").fadeIn();
                          });
                      }) ;    
                    });
            });

            $("#agregarAlBorrador").live("hover",function(e){
                    $(this).css("cursor","pointer");
            });

            $("#editar").live("hover",function(e){
                            $(this).css("cursor","pointer");
            });

           $('.detalleElemBorrador').live("click", function(e){
              var id=$(this).find('input[type=hidden]').val();
              $("#table-content").load('vistaDetalle.php' , {id_sol: id} ).promise().done(function(e){
                   $('#table-content').show().promise().done(function(e){
                        $("div.contenedorEmergente").show(); 
                    });
                }) ;
          });

           $('#cerrarDetalle').live("click", function(e){
               $("#table-content").html("").promise().done(function(e){
                  $("#table-content").hide().promise().done(function(e){
                     $('div.contenedorEmergente').hide();
                  });
              }) ;
            });

            function aviso(elemento){
                $("#table-content").fadeOut().promise().done(function(){
                     $('div.contenedorEmergente').hide();
                     $("#page-heading").html(elemento);   
                     $("#carrito").load('Borrador.php');
                });
            }

      $('#vistaAltaSolicitud').click(function(e){
          $("#table-content").load('FormAltaModSolicitudBorrador.php').promise().done(function(){
            $("#page-heading").html("<h1>Opcion ALta</h1>");
            $(this).show().promise().done(function(e){
              $('div.contenedorEmergente').show();  
            });
          });
      });
       
      
      $('#vistasSolicitudesBorrador').click(function(e){
          $("#table-content").hide().promise().done(function(){
                      $('div.contenedorEmergente').hide();
                      $("#carrito").load('Borrador.php',{ estado: 0 }).promise().done(function(){
                          $("#page-heading").html("<h1>Pendientes</h1>");     
                       });
          });
      });
        
      
      $('#vistaSolicitudesEnviadas').click(function(e){
          $("#table-content").hide().promise().done(function(){
                        $('div.contenedorEmergente').hide();
                       $("#carrito").load('Borrador.php',{ estado: '-2' }).promise().done(function(){
                          $("#page-heading").html("<h1>Solicitudes Enviadas</h1>");     
                       });
          });
      });
      $('#homeUser').click(function(e){
        $(location).attr('href','index.php');
      });
});