<?php  
	         
	session_start();

	require_once('classes/Status.php');
	require_once('classes/Messages.php');
	require_once('classes/Data.php');
	require_once('classes/Select_control.php');
	require_once('models/config.php');
	require_once('models/Server.php');
	require_once('models/Login.php');

	$login = new Login();
			
	$error = '';
	$msg = '';
	$visibleForm = "hidden";
	
	if($login -> session_verify()){

		//fichero con datos del usuario
		
		require_once('models/user_data.php');

		if(!$login -> is_admin($userType)){
	
			echo Messages::msg('No dispone de los permisos para ingresar a esta seccion');
	
		}else{	

			$levelsNumber= 0;
			$noClassroom = 0;
			$noSignatures = 0;
			$setDate = '';

			//obtener fecha de actualizacion
			require_once('modules/colegio/models/School.php');

			$school = new School();

            $getSetDate = $school -> get_set_date();

            $setDate = $getSetDate['data'];
      
      		//obetner numero de grados
			require_once('modules/grados/models/Level.php');

			$level = new Level();

            $getLevelsNumber = $level -> get_levels_number();

            $levelsNumber = $getLevelsNumber['data'];
           
           //obtener numero de materias
           require_once('modules/materias/models/Signature.php');

			$signature = new Signature();

            $getSignaturesNumber = $signature -> get_signatures_number();

            $signaturesNumber = $getSignaturesNumber['data'];

            //obtener numero de grupos
            require_once('modules/grupos/models/Group.php');

			$group = new Group();

            $getGroupsNumber = $group -> get_groups_number();

            $groupsNumber = $getGroupsNumber['data'];   

            //mensajes de error o aviso 
            $msg = $getSetDate['notice'].$getLevelsNumber['notice'].$getSignaturesNumber['notice'];  

            //cargar la vista 
			require_once("modules/colegio/views/theme/school_view.php");

		}
	
	}else{
	
		echo Messages::msg('Contenido no disponible <br> <a href="index.php">Login</a>',
							'info');  		
 
  	}

?>