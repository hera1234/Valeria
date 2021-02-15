<?php  
	
	session_start();

    require_once('../../../../classes/Data.php');
    require_once('../../../../classes/Messages.php');
    require_once('../../../../classes/Status.php');
    require_once('../../../../models/config.php');
    require_once('../../../../models/Server.php');
    require_once('../../../../models/Login.php');
 	require_once('../../models/School.php');   

 	$school = new School(); 
	
	if(isset($_POST["request"])){

			$data = json_decode($_POST['request']);

			switch ($data -> request) {
				
				case 'set_data':

					$update = $school -> set_data($data -> data);
				
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



           	 