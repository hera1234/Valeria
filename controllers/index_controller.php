<?php  
	         
	session_start();

	require_once('classes/status.php');
	require_once('classes/Messages.php');
	require_once('classes/Data.php');
	require_once('models/config.php');
	require_once('models/Server.php');
	require_once('modules/colegio/models/School.php');
	require_once('models/Login.php');
	
	

	$login = new Login();
			
	$error = '';
	$msg = '';
	
	$visibleForm = "hidden";

	
	if($login -> session_verify()){
	
		header('location:principal.php');
	
	}else{
	
		if(isset($_POST['loginBtn'])){
	
	  		$user = $_POST['user'];
	 		$password = $_POST['password'];
	 		$userType = $_POST['userType'];
	 		
	 		switch ($userType) {
	 			case 'admin':
	 			
	 				require_once('modules/usuarios/models/User.php');
	 				$login -> create_user_object(new User());	 

	 			break;
	 			case 'prof':

					require_once('modules/profesores/models/Teacher.php'); 				
	 				$login -> create_teacher_object(new Teacher());	  

	 			break;
	 			default:
	 				
	 			break;
	 		}

	 		$login -> create_school_object(new School());	  

	  		$msg = $login -> login($user, $password, $userType);	  
	 
	 	}else{
	 		
	 		//formulario de login
	 		$visibleForm = "visible";
 
 		}//boton entrar
      
  		require_once("views/theme/index_view.php");
 
  	}//verificar inicio de sesion

?>