<?php  
	         			
	$error = '';
	$msg = '';
	$visibleForm = "hidden";
	
	if($login -> session_verify()){

		require_once('models/user_data.php');

		if(!$login -> is_teacher($userType)){
	
			echo Messages::msg('No dispone de los permisos para ingresar a esta seccion');
	
		}else{	

			require_once("modules/profesores/views/theme/change_password_view.php");

		}
	
	}else{
	
		echo Messages::msg('Contenido no disponible <br> <a href="index.php">Login</a>',
							'info');  		
 
  	}

?>