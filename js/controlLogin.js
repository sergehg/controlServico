$(function() { 
	    var user="",pass="";

			$(".submit-login").click(function () {
				$("#loginbox").hide();
	            $.logeo( $("#usuario").val() ,  pass=$("#clave").val() );
			});//fin boton submit-login;

			$.logeo =  function(user , pass){
				 $.ajax({
						url:'validaUsuario.php',
						type : "POST",
						data : "usuario="+user+"&clave="+pass,
						success: function(response)
						{

							if($.trim(response) == 'success'){
										$(location).attr('href','index.php');
										console.log(response);

							}else{
									//$("#forgotbox").show();
									runEffect();
									
									console.log(response);
							}
						}
					});
				
			};//fin funcion logeo

            $(".back-login").click(function () {
					   
				            $("#forgotbox").hide();
				            $("#loginbox").show();
				            return false;
				});

				function callbackEffect() {

		            setTimeout(function() {
		                    $( "#forgotbox:visible" ).show();
		            }, 800 );
		        }

		       function runEffect(){
			
		                $("#loginbox").hide();
		             
		                var selectedEffect = "fold";
		                var options = {};
		                $("#forgotbox").show( selectedEffect, options, 350 );
		        }

});

