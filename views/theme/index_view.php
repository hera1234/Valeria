<!doctype html>
<html>
	<head>
	
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		
		<title>Colegio</title>
		
		<link rel="shortcut icon" href="views/theme/ico/school-buss.ico">
		<link rel="stylesheet" type="text/css" href="views/theme/css/general.css">
		<link rel="stylesheet" type="text/css" href="views/theme/css/index.css">
		
	</head>
	<body>

		<div class="main-container">

	    	<h1 class="login-title">Login</h1>

	    	<div class="form-wrap">
	        	
	        	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="login-form">
	            
	            	<div class="head-formLogin">
	            		<img src="views/theme/img/illustrator-old-school-icon.png" class="img-formLogin">
	            	</div>
	        			
        			<div class="controls-wrap <?php echo $visibleForm;?>">
        				<div class=""><?php echo $msg;?></div>
						<div class="controls-group">
							<input type="text" name="user" placeholder="Usuario" class="form-loginControl" id="usuario"><br>
							<input type="password" name="password" placeholder="Password" class="form-loginControl" id="password">
							<select name="userType" class="form-loginControl select-login" id="user-type">
								<option value="" selected="">Seleccione una opcion</option>
								<option value="admin">Administrador</option>
								<option value="prof">Profesor</option>
							</select>
						</div>
						
						<div class="btns-container">
						
							<input type="submit" name="loginBtn" id="login-btn" value="Login" class="btn login-btn">
						
						</div>

					</div>
					<div class="msg-wrap">
						<?php  
							echo $msg;
						?>
					</div>

				</form>
								
			</div>
	    
	    </div>

	</body>

</html>