<?php 
	
	session_start();

	require_once('classes/Status.php');
	require_once('classes/Messages.php');
	require_once('classes/Data.php');
	require_once('models/config.php');
	require_once('models/Server.php');
	require_once('models/Login.php');
	
	$login = new Login();
	
	require_once('models/user_data.php'); 
	         
	switch ($userType) {
		
		case 'admin':

			require_once("modules/usuarios/controllers/acount_controller.php");

		break;
		case 'prof':
						
			require_once("modules/profesores/controllers/acount_controller.php");

		break;
		default:
				
			echo "No se reconoce el tipo de usuario";

		break;
	
	}

?>