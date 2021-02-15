<?php  
	         		
	$error = '';
	$msg = '';
	$visibleForm = "hidden";
	
	if($login -> session_verify()){
	
		if(!$login -> is_admin($userType)){
	
			echo Messages::msg('No dispone de los permisos para ingresar a esta seccion');
	
		}else{	

			require_once('modules/usuarios/models/User.php');

			$user = new User();

			$setForm = $user -> get_form_setData($userId);

			require_once("modules/usuarios/views/theme/acount_view.php");

		}
	
	}else{
	
		echo Messages::msg('Contenido no disponible <br> <a href="index.php">Login</a>',
							'info');  		
 
  	}

?>