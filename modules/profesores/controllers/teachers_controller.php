<?php  
	         
	session_start();

	require_once('classes/Status.php');
	require_once('classes/Messages.php');
	require_once('classes/Select_control.php');
	require_once('classes/Data.php');
	require_once('models/config.php');
	require_once('models/Server.php');
	require_once('models/Login.php');

	$login = new Login();
			
	$error = '';
	$msg = '';
	$visibleForm = "hidden";
	
	if($login -> session_verify()){

		require_once('models/user_data.php');

		if($login -> is_admin($userType) || $login -> is_teacher($userTye)){

			require_once('modules/grados/models/Level.php');

			$level = new Level();

            $optionsL = $level -> get_selectOptions();

            $optionsL = $optionsL['data'];       

            require_once('modules/profesores/models/Teacher.php');

			$teacher = new Teacher();

            $selectTeacher = $teacher -> get_selectOptions();

            $selectTeacher = $selectTeacher['data'];
	
			require_once("modules/profesores/views/theme/teachers_view.php");

		}else{	

			echo Messages::msg('No dispone de los permisos para ingresar a esta seccion');
	
		}
	
	}else{
	
		echo Messages::msg('Contenido no disponible <br> <a href="index.php">Login</a>',
							'info');  		
 
  	}

?>