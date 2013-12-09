
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Proyecto controlService</title>

     

        <script type="text/javascript" src="js/jquery/jquery-1.8.2.min.js"></script>
	    <script type="text/javascript" src="js/jquery/jquery-ui-1.8.9.custom.min.js"></script>
        <script type="text/javascript" src="js/controlLogin.js"></script>
	<!--<script type="text/javascript" src="js/jquery/Micustom.js"></script>-->


	<script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>

        <script type="text/javascript">
               $(document).ready(function(){
                    $(document).pngFix( );
                });
        </script>

        <style type="text/css">
			div#imageLogo{
				width: 93px;
				height: 115px;
				margin: 0 auto;
				margin-top: -75px;
				margin-bottom: 20px;
 				background: url('images/shared/logo.jpg') no-repeat ;
 				background-size: 100% 100%;
 				color: red;
			}
			#datosLogin{
				border-top: 1px solid black;
				padding-top: 20px;
			}
			.submit-login	{
				background: url(images/login/submit_login.gif) no-repeat;
				border: none;
				cursor: pointer;
				display: block;
				height: 29px;
				text-indent: -3000px;
				width: 73px;
				}
			.submit-login:hover	{
				background: url(images/login/submit_login.gif) no-repeat 0 -29px;
				}

			a.back-login	{
				background: url(images/login/icon_back_login.gif) no-repeat 0 4px;
				bottom: 30px;
				color: #161616;
				font-family: Tahoma;
				font-size: 11px;
				font-weight: bold;
				line-height: 12px;
				padding: 0 0 0 10px;
				position: absolute;
				right: 40px;
			}
			a:hover.back-login	{
				color: #fff;
				}
			#login-bg	{
				/*background: url(../images/login/login_bg.jpg) no-repeat top center;*/
				}
			#login-holder	{
				width: 508px;
				margin: 0 auto;
				margin-top: 100px;
				}
			#loginbox	{
				/*background: url(../images/login/loginbox_bg.png) no-repeat;*/
				font-size: 12px;
				height: 212px;
				line-height: 12px;
				padding-top: 60px;
				position: relative;
				width: 508px;
				}
			#forgotbox	{
				background: url(images/login/loginbox_bg.png) no-repeat;
				display: none;
				font-size: 12px;
				height: 212px;
				line-height: 12px;
				padding-top: 60px;
				position: relative;
				width: 508px;
				}
			#login-inner	{
				color: #161616;
				font-family: Tahoma;
				font-size: 13px;
				line-height: 12px;
				margin: 0 auto;
				width: 310px;
				}
			#login-inner label	{
				color: #161616;
				cursor: pointer;
				font-family: Tahoma;
				font-weight: bold;
				line-height: 12px;
				padding-left: 10px;
				 
				}
			 .checkbox-size	{
				width:13px;
				height:13px;
				margin: 5px 0;
				 
				}	
			#login-inner th	{
				padding: 0 0 6px 0;
				text-align: left;
				width: 95px;
				}
			#login-inner td	{
				padding: 0 0 6px 0;
				}
			.login-inp	{
				background-color: #CDD2D8;
				border: none;
				color: #fff;
				font-weight: bold;
				font-size: 16px;
				height: 28px;
				padding: 6px 6px 0 10px;
				width: 204px;
				}
			/*#logo-login	{
				float: left;
				height: 35px;
				margin: 145px 0 0 15px;
				}*/
			a.forgot-pwd	{
				bottom: 30px;
				color: #161616;
				font-family: Tahoma;
				font-size: 11px;
				font-weight: bold;
				line-height: 12px;
				position: absolute;
				right: 40px;
				}
			a:hover.forgot-pwd	{
				color: #fff;
				}
			#forgotbox-text	{
				color: #161616;
				font-family: Tahoma;
				font-size: 13px;
				font-weight: bold;
				line-height: 12px;
				margin: 0 auto 40px auto;
				width: 380px;
				}
			#forgot-inner	{

				color: #161616;
				font-family: Tahoma;
				font-size: 20px;
				line-height: 19px;
				margin: 0 auto;
				width: 330px;
				vertical-align: middle;

				}
			#forgot-inner label {
				color: #161616;

				font-family: Tahoma;
				font-weight: bold;
				line-height: 19px;
				padding-left: 10px;
				}
				#forgot-inner p{
					padding-left: 10px;	

				}

        </style>
</head>
<body id="login-bg"> 
	<div id="login-holder">
		<div class="clear"></div>
		
		<!--  start loginbox ................................................................................. -->
		<div id="loginbox">
			<div id="login-inner">
	  				<div id ="imageLogo"> </div>
					<div id="datosLogin">
					    <table border="0" cellpadding="0" cellspacing="0" >
										<tr>
							                <th>Usuario</th>
											<td><input id="usuario" type="text" name="usuario" class="login-inp" /></td>
										</tr>
										<tr>
											<th>Clave</th>
											<td><input id="clave" type="password" name="clave" value=""  onfocus="this.value=''" class="login-inp" /></td>
										</tr>
										<tr>
											<th></th>
											<td valign="top"></td>
										</tr>
										<tr>
											<th></th>
											<td><input type="button" class="submit-login"  /></td>
										</tr>
						</table>
					</div>
			</div>
			<div class="clear"></div>
		</div>
	<!-- 	<div>
			<input type="hidden" id="respuestaPost" value="<?= $_REQUEST['datos'] ?> "/>
		</div>
	 -->
	 	<div id="forgotbox">
	                <div id="forgot-inner">
			            <label>Datos invalidos</label>
			            <p>
			            	Favor de reintentar de nuevo
			            </p>
					</div>
			<div class="clear"></div>
			<a href="" style="display:block" class="back-login">regreso al login</a>
		</div>
	</div>
<!-- End: login-holder -->
</body>
</html>