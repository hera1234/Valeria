<?php  
	
	session_start();

    require_once('../../../../classes/Data.php');
    require_once('../../../../classes/Messages.php');
    require_once('../../../../classes/Status.php');
    require_once('../../../../models/config.php');
    require_once('../../../../models/Server.php');
    require_once('../../../../models/Login.php');
 	require_once('../../../../modules/profesores/models/Qualification.php');   

 	$qualification = new Qualification(); 
	
	if(isset($_POST["request"])){

			$data = json_decode($_POST['request']);

			$login = new Login();
			
			require_once('../../../../models/user_data.php');

			switch ($data -> request) {

				case 'get_data_form':

					$group = $data -> data -> group;
					$student = $data -> data -> student;
					$level = $data -> data -> level;
					$teacher = $data -> data -> teacher;


					$getData = $qualification -> get_qualifications_form($userId, $level, $group, $student);

					$data = Status::get_status($getData["status"], $getData["notice"], $getData["data"]); 
							
				break;
				case 'set_qualifications':

					$dataForm =  $data -> data;
					
					$update = $qualification -> set_qualifications($dataForm);
				
					$data = Status::get_status($update["status"], $update["notice"], $update["data"]);

				break;
				default:
				
					$data = Status::get_status("error", "Request no valida", "Request no valida");
				
				break;
			
			}

	}else{

		$data = Status::get_status("error", "Falta request", "error");

	}

	$jsonData = json_encode($data);

	echo $jsonData;

?>



           	 