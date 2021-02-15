<?php  
	         
	session_start();

	require_once('classes/status.php');
	require_once('classes/Messages.php');
	require_once('classes/Data.php');
	require_once('models/config.php');
	require_once('models/Server.php');
	require_once('models/Login.php');
	require_once('modules/colegio/models/School.php');

	$login = new Login();
	$school = new School();
			
	$error = '';
	$msg = '';
	$visibleForm = "hidden";
	
	if($login -> session_verify()){

		require_once('models/user_data.php');
		require_once('models/school_data.php');

		$content = "";
	
		switch ($userType) {

			case 'admin':
				
				require_once("modules/usuarios/views/theme/main_view.php");

			break;
			case 'prof':

				require_once('modules/grupos/models/Group.php');
				require_once('modules/profesores/models/Teacher.php');

				$group = new Group();

				$teacher = new Teacher();
					
				$teacher -> get_group_instance($group);

				//mostrar tabla de grupos
				$data = $teacher -> get_groups_table($userId);

				$headerTable = '<tr><th>Grupo</th><th>Grado</th></tr>';

				if($data['status'] == 'done'){

					$content = $headerTable;

					for($i = 0; $i < count($data['data']); $i++) {
						
						$content .= $data['data'][$i]['tr'];	
					}
					

				}else{


					$content = Messages::status_notice($data['status'],  $data['notice']);
				}

				require_once("modules/profesores/views/theme/main_view.php"); 

			break;		
			default:
				
				session_destroy();

				echo 'Tipo de usuario no identificado';

			break;

		}

	}else{
	
		echo Messages::msg('Contenido no disponible <br> <a href="index.php">Inicio</a>',
							'info');  		
 
  	}

?>