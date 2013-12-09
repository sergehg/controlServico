$(document).ready(function(){
    $("#verformActividades").click(function(){
	$("#page-heading").html("<h1>Formulario Actividades</h1>");
	$("#table-content").load('formActividades.php');
    });
    $("#aceptarActividades").click(function(){
	    var lista= document.getElementById("opcionesNombreProfesor");
	    nombre=lista.options[lista.selectedIndex].text;
	    
	    lista= document.getElementById("opcionesTipoActividad");
	    tipo=lista.options[lista.selectedIndex].value;
	    
	    lista= document.getElementById("opcionesGrupo");
	    grupo=lista.options[lista.selectedIndex].value;
	    
	    duracion=$("#duracionAct").val();
	    
	    consecutivo=$("#consecutivoAct").val();
	    
	    scripSQL="INSERT INTO `cbtis`.`actvidades` (`id` ,`Nombre` ,`tipo_act` ,`grupo_id` ,`Duracion` ,`consecutivo`)"+
			"VALUES (NULL , '"+nombre+"','"+tipo+"','"+grupo+"','"+duracion+"','"+consecutivo+"');";
	    alert("instruccion "+scripSQL);
	    $.get("usuarios.php",{accion:"NEW",db:"cbtis",servidor:"localhost",sql:scripSQL},
	    function(data){
			      if(!data){
				      $("#table-content").html("<span ><b>Error</b> <br/> "+data);
			      }
			      else{
				  $("#page-heading").html("<h1>Actividades</h1>");
				  $("#table-content").html("<span ><b>Realizado Correctamente</b> <br/> ");
				  $("#table-content").load('formActividades.php');
			      }
		
	    });//fin get	
			    
	
    });
    
    

});

// GRUPO *********************************************
$(document).ready(function(){

    $("#verformGrupo").click(function(){
	$("#page-heading").html("<h1>Formulario Grupo</h1>");
	$("#table-content").load('formGrupo.php');
        $('input').checkBox();
        $('#toggle-all').click(function(){
            $('#toggle-all').toggleClass('toggle-checked');
            $('#mainform input[type=checkbox]').checkBox('toggle');
            return false;
        });
                
        $('a.info-tooltip ').tooltip({
                track: true,
                delay: 0,
                fixPNG: true, 
                showURL: false,
                showBody: " - ",
                top: -35,
                left: 5
        });
    });//fin de verFormGrupo
    
    $("#aceptarGrupo").click(function(e){
        
	nombre=$("#nombreGrup").val();
	ciclo=$("#cicloGrup").val();
	group=$("#alumGrup").val();
	
	scripSQL="INSERT INTO `cbtis`.`Grupo` ("+
						"`id` ,"+
						"`nombre` ,"+
						"`ciclo` ,"+
						"`alumnos`"+
						")"+
						"VALUES ("+
						"NULL , '"+nombre+"','"+ciclo+"','"+group+"'"+
						");";
    alert("instruccion" +scripSQL);
    $.get("usuarios.php",{accion:"NEW",db:"cbtis",servidor:"localhost",sql:scripSQL},
          
		function(data){
		    
		      alert("el resultado es "+data);
	      
			  if(!data){
                                 alert("problemas");
				  $("#table-content").html("<span ><b>Error</b> <br/> "+data);
			  }
			  else{
			      $("#page-heading").html("<h1>Grupos</h1>");
			      $("#table-content").html("<span ><b>Realizado Correctamente</b> <br/> ");
			      $("#table-content").load('formGrupo.php');
                              
	       
			  }
	    
    });//fin get
       
    });
    
});
// FIN GRUPO *********************************************

$(document).ready(function(){
    $("#verformHorario").click(function(){
	$("#page-heading").html("<h1>Formulario Horario</h1>");
	$("#table-content").load('formHorario.php');
    });
});


//FORM lUGARES *******************************
$(document).ready(function(){
    $("#verformLugares").click(function(){
	$("#page-heading").html("<h1>Formulario Lugares</h1>");
	$("#table-content").load('formLugares.php');
	$('input').checkBox();
        $('#toggle-all').click(function(){
            $('#toggle-all').toggleClass('toggle-checked');
            $('#mainform input[type=checkbox]').checkBox('toggle');
            return false;
        });
        $('a.info-tooltip ').tooltip({
                track: true,
                delay: 0,
                fixPNG: true, 
                showURL: false,
                showBody: " - ",
                top: -35,
                left: 5
        });
    });//FIN VERFORMlUGARES
    
    $("#aceptarLugares").click(function(){
	nombre=$("#nombreLug").val();
	capacidad=$("#capLug").val();
	
	scripSQL="INSERT INTO `cbtis`.`Lugares` ("+
						"`id` ,"+
						"`nombre` ,"+
						"`capacidad` ,"+
						"`edo`"+
						")"+
						"VALUES ("+
						"NULL , '"+nombre+"','"+capacidad+"','1'"+
						");";
	
	
	$.get("usuarios.php",{accion:"NEW",db:"cbtis",servidor:"localhost",sql:scripSQL},
          	function(data){
		      alert("el resultado es "+data);
	    		  if(!data){
				  $("#table-content").html("<span ><b>Error</b> <br/> "+data);
			  }
			  else{
			      $("#page-heading").html("<h1>Lugares</h1>");
			      $("#table-content").html("<span ><b>Realizado Correctamente</b> <br/> ");
			      $("#table-content").load('formLugares.php');
			  }
	});//fin get
    
    
    });
});
//END FORM lUGARES *******************************

//Materia *********************
$(document).ready(function(){
    $("#verformMateria").click(function(){
	$("#page-heading").html("<h1>Formulario Materia</h1>");
	$("#table-content").load('formMateria.php');
    });
    $("#aceptarMateria").click(function(){
	var lista = document.getElementById("opciones");
	// Obtener el valor de la opción seleccionada
	valorSeleccionado = lista.options[lista.selectedIndex].value;
	nombre=$("#nomMat").val();
	
	scripSQL="INSERT INTO `cbtis`.`materia` (`id` ,`Nombre` ,`preferida_id`)"+
		    "VALUES (NULL , '"+ nombre+"', '"+ valorSeleccionado +"');";
	
	$.get("usuarios.php",{accion:"NEW",db:"cbtis",servidor:"localhost",sql:scripSQL},
        function(data){
			  if(!data){
				  $("#table-content").html("<span ><b>Error</b> <br/> "+data);
			  }
			  else{
			      $("#page-heading").html("<h1>Materias</h1>");
			      $("#table-content").html("<span ><b>Realizado Correctamente</b> <br/> ");
			      $("#table-content").load('formMateria.php');
			  }
	    
	});//fin get

    });//fin aceptar Materia
    
});
// end Materia*******************

//Profesor *********************
$(document).ready(function(){
    $("#verformProfesor").click(function(){
	$("#page-heading").html("<h1>Formulario Profesor</h1>");
	$("#table-content").load('formProfesor.php');
    });
    $("#aceptarProfesor").click(function(){
	nombre=$("#nombProfe").val();
	apaterno=$("#patProfe").val();
	amaterno=$("#matProfe").val();
	clave=$("#claveProfe").val();
	var lista= document.getElementById("opciones");
	lugar=lista.options[lista.selectedIndex].value;
	
	
	scripSQL="INSERT INTO `cbtis`.`Profesor` (`id` ,`nombre` ,`Apaterno` ,`Amaterno` ,`clave` ,`lugar`)"+
		"VALUES (NULL , '"+nombre+"','"+apaterno+"','"+amaterno+"','"+clave+"','"+lugar+"');";
	
	$.get("usuarios.php",{accion:"NEW",db:"cbtis",servidor:"localhost",sql:scripSQL},
        function(data){
			  if(!data){
				  $("#table-content").html("<span ><b>Error</b> <br/> "+data);
			  }
			  else{
			      $("#page-heading").html("<h1>Profesor</h1>");
			      $("#table-content").html("<span ><b>Realizado Correctamente</b> <br/> ");
			      $("#table-content").load('formProfesor.php');
			  }
	    
	});//fin get

    
    });
});
//END Profesor***********************

//Tipo Actividades
$(document).ready(function(){
    $("#verformTipoAct").click(function(){
	$("#page-heading").html("<h1>Formulario TipoActividades</h1>");
	$("#table-content").load('formTipoActividades.php');
	
    });
    $("#aceptarActividades").click(function(){
	nombre=$("#nombTipAct").val();
	var lista= document.getElementById("opciones");
	valorSeleccionado=lista.options[lista.selectedIndex].value;
	scripSQL="INSERT INTO `cbtis`.`TipoActividades` (`id` ,`nombre` ,`preferida_id`)"+
		    "VALUES (NULL , '"+ nombre+"', '"+ valorSeleccionado +"');";
	$.get("usuarios.php",{accion:"NEW",db:"cbtis",servidor:"localhost",sql:scripSQL},
        function(data){
			  if(!data){
				  $("#table-content").html("<span ><b>Error</b> <br/> "+data);
			  }
			  else{
			      $("#page-heading").html("<h1>Tipo de Actividades</h1>");
			      $("#table-content").html("<span ><b>Realizado Correctamente</b> <br/> ");
			      $("#table-content").load('formTipoActividades.php');
			  }
	    
	});//fin get	    
    });
});
//End TipoActividades

$(document).ready(function(){
    
    $("#genera").click(function(){
	$("#page-heading").html("<h1>Tipo de Actividades</h1>");
	
	
	HTML='<div id="message-yellow">'+
	    '<table border="0" width="100%" cellpadding="0" cellspacing="0">'+
	     '<tr>'+
		     '<td class="yellow-left" id="mensajeProseso">EN PROCESO  . . .</td>'+
		     '<td class="yellow-right"><a class="close-yellow"><img src="images/table/icon_close_yellow.gif"   alt="" /></a></td>'+
	     '</tr>'+
	    '</table>'+
	'</div>'
	
	$("#table-content").html(HTML);
	$(".close-yellow").click(function () {
		$("#message-yellow").fadeOut("slow");
	});
    });

});