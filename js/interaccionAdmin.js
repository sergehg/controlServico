
$(function(e){

            $("#table-content").fadeOut();
             $('div.contenedorEmergente').fadeOut();
            $('#cargador').ajaxStart(function(){
                $(this).show();
              }).ajaxStop(function(){
                $(this).hide();
              });
          

            $("#cancelarForm").live("click",function(){
                $("#table-content").fadeOut().promise().done(function(){
                     $("#page-heading").html("<h1>Su tiempo es oro</h1>");  
                     $('div.contenedorEmergente').fadeOut(); 
                });
            });

/////////////////////////////////////////////////////////////////////////////////////////////////////////
            $('.aceptarElemBorrador').live("click", function(e){
                    
                    var id=$(this).find('input[type=hidden]').val();
                    var desicion=confirm("Quiere ACEPTAR ESTA SOLICITUD ?");
                    if (desicion) {
                        var datos="opcion=ACEPTAR&id_sol="+id;
                          $.ajax({
                            
                            type: "POST",
                            url: "AccionesControlSolicitudAdmin.php",
                            data: datos,
                            contentType: "application/x-www-form-urlencoded;charset=UTF-8",
                            success: function(data){
                                if($.trim(data) == 'success'){
                                      HTML='<h1 class="green-left">Tarea realizada con EXITO tu solicitud ha sido ACEPTADA</h1>';
                                      aviso(HTML);
                                      //window.location.href("MiPDF.php&id_sol="+id);
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
                      
                            
                          });//FIN AJAX
                    }//FIN SI

            });
///////////////////////////////////////////////////////////////////////////////////////////////////
            $('.rechazarElemBorrador').live("click", function(e){
                    
                    var id=$(this).find('input[type=hidden]').val();
                    var desicion=confirm(" Quiere RECHAZAR ESTA SOLICITUD ?");
                    if (desicion) {
                        var datos="opcion=RECHAZAR&id_sol="+id;
                          $.ajax({

                            type: "POST",
                            url: "AccionesControlSolicitudAdmin.php",
                            data: datos,
                            contentType: "application/x-www-form-urlencoded;charset=UTF-8",
                            success: function(data){
                                if($.trim(data) == 'success'){
                                      HTML='<h1 class="green-left">Tarea realizada con EXITO </h1>';
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
                        
                            
                          });//FIN AJAX
                    }//FIN SI

            });
////////////////////////////////////////////////////////////////////////   
$('#reporte').live("click",function(){
     $(location).attr('href','excel.php');
});
/////////////////////////////////////////////////////////////////////////     
$('.detalleElemBorrador').live("click", function(e){
    var id=$(this).find('input[type=hidden]').val();
    $("#table-content").load('vistaDetalle.php' , {id_sol: id} ).promise().done(function(e){
      $('#table-content').show().promise().done(function(e){
        $("div.contenedorEmergente").show(); 
    });
  }) ;
});
///////////////////////////////////////////////////////////////////////////////   
$('#cerrarDetalle').live("click", function(e){
      $("#table-content").html("").promise().done(function(e){
        $('div.contenedorEmergente').fadeOut().promise().done(function(e){
          $("#table-content").hide();  
        });
      }) ;;
});
function aviso(elemento){
    $("#table-content").fadeOut().promise().done(function(){
         $("#page-heading").html(elemento);   
         $('div.contenedorEmergente').fadeOut();
         $("#carrito").load('controlSolicitudAdmin.php').promise().done(function(){
            
         });

    });
}


$('#vistaSolicitudesEnviadas').click(function(e){
  $("#table-content").hide().promise().done(function(){
                  $('div.contenedorEmergente').fadeOut();
                  $("#carrito").load('controlSolicitudAdmin.php',{ estado: 1 }).promise().done(function(){
                      $("#page-heading").html("<h1>Solicitudes Enviadas</h1>");     
                   });
  });
});

$('#vistasSolicitudesAceptadas').click(function(e){
  $("#table-content").hide().promise().done(function(){
                    $('div.contenedorEmergente').fadeOut();
                    $("#carrito").load('controlSolicitudAdmin.php',{ estado: 2 }).promise().done(function(){
                        $("#page-heading").html("<h1>Solicitudes Aceptadas</h1>");      
                   });
  });
});
        
 $('#homeAdmin').click(function(e){
   $(location).attr('href','indexAdmin.php');
 });


});