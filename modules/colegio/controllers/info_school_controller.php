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

		if(!$login -> is_admin($userType)){
	
			echo Messages::msg('No dispone de los permisos para ingresar a esta seccion');
	
		}else{	

            $schoolName='';
            $country='';
            $city='';
            $address='';
            $email='';
            $tel='';
            $webSite='';
            $setDate='';
            $idSchool='';

            require_once('modules/colegio/models/School.php');

			$school = new School();

            $getData = $school -> load_data_updateForm();

            if($getData['status'] == 'done'){

            	$dataForm = $getData['data'];

            	$schoolName=$dataForm['nombre'];
	            $country=$dataForm['pais'];
	            $city=$dataForm['ciudad'];
	            $address=$dataForm['direccion'];
	            $email=$dataForm['correo'];
	            $tel=$dataForm['tel'];
	            $webSite=$dataForm['web'];
	            $setDate=$dataForm['ic_fechaDeActualizacion'];
	            $idSchool=$dataForm['id'];
	 			
            }else{


            	echo Messages::info_msg($getData['notice']);

            }
            
			require_once("modules/colegio/views/theme/info_school_view.php");

		}
	
	}else{
	
		echo Messages::msg('Contenido no disponible <br> <a href="index.php">Login</a>',
							'info');  		
 
  	}

?>