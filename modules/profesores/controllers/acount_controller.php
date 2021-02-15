<?php  
	         
			
	$error = '';
	$msg = '';
	$visibleForm = "hidden";
	
	if($login -> session_verify()){

		if(!$login -> is_teacher($userType)){
	
			echo Messages::msg('No dispone de los permisos para ingresar a esta seccion');
	
		}else{	

			require_once('modules/profesores/models/Teacher.php');	

			$teacher = new Teacher();

			$setForm = $teacher -> get_form_setData($userData);

			require_once("modules/profesores/views/theme/acount_view.php");

		}
	
	}else{
	
		echo Messages::msg('Contenido no disponible <br> <a href="index.php">Login</a>',
							'info');  		
 
  	}

?>