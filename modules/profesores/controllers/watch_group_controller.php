<?php  
	         
	session_start();

	require_once('classes/Status.php');
	require_once('classes/Messages.php');
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

		if($login -> is_admin($userType) || $login -> is_teacher($userType)){	

            if(Data::empty_data($_GET['group'])){

            	$groupId = $_GET['group'];
  
              	require_once('modules/grupos/models/Group.php');

				$group = new Group();

				$getName = $group -> get_groupName($groupId);

				$groupName = $getName;


            	require_once('modules/profesores/models/Teacher.php');

				$teacher = new Teacher();

				//cargar lista de alumnos del grupo seleccionado
	            $getStudentTable = $teacher -> get_students_byGroup($groupId, $userId);

	            require_once('modules/profesores/models/Qualification.php');

				$qualification = new Qualification();

	            $table = $qualification -> headTableSCR;

	            if($getStudentTable['status'] == 'done'){

	            	$table = $getStudentTable['data'];

	            }else{

	            	$table = Messages::status_notice($getStudentTable['status'],
	            									 $getStudentTable['notice']);

	            }

	        }else{

	        	$table = Messages::status_notice('no-data', 'Sin profesor');

	        }

			require_once("modules/profesores/views/theme/watch_group_view.php");

		}else{
	
			echo Messages::msg('No dispone de los permisos para ingresar a esta seccion');
	
		}
	
	}else{
	
		echo Messages::msg('Contenido no disponible <br> <a href="index.php">Login</a>',
							'info');  		
 
  	}

?>