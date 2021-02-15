<?php  
	
	session_start();

    require_once('../../../../classes/Data.php');
    require_once('../../../../classes/Messages.php');
    require_once('../../../../classes/Status.php');
    require_once('../../../../models/config.php');
    require_once('../../../../models/Server.php');
    require_once('../../../../models/Login.php');
 	require_once('../../models/Student.php');   

 	$student = new Student(); 
	
	if(isset($_POST["request"])){

			$data = json_decode($_POST['request']);

			switch ($data -> request) {

				case 'search-student':

					$search = $data -> data;

					$getData = $student -> search_data($search);
					
					$data = Status::get_status($getData['status'], $getData['notice'], $getData['data']);

				break;
				case 'add-student':

					$add = $student -> add_data($data -> data);
				
					$data = Status::get_status($add["status"], $add["notice"], $add["data"]); 
							
				break;
				case 'get_data_setForm':

					$getData = $student -> load_data_updateForm($data -> idStudent);
				
					$data = Status::get_status($getData["status"], $getData["notice"], $getData["data"]); 
							
				break;
				case 'set_data':

					$update = $student -> set_data($data -> data);
				
					$data = Status::get_status($update["status"], $update["notice"], $update["data"]);

				break;
				case 'get-signaturesList':

					$getData = $student -> get_signatures($data -> studentId);
				
					$data = Status::get_status($getData["status"], $getData["notice"], $getData["data"]); 
							
				break;
				case 'update-status':

					$update = $student -> update_status($data -> data -> status, $data -> data -> id);
				
					$data = Status::get_status($update["status"], $update["notice"], $update["data"]);

				break;
				case 'del-data':

					$del = $student -> del_data($data -> idStudent);;
				
					$data = Status::get_status($del["status"], $del["notice"], $del["data"]);


				break;
				default:
				
					$data = Status::get_status("error", "Request no valida", "Error");
				
				break;
			
			}

	}else{

		$data = Status::get_status("error", "Falta request", "Error");

	}

	$jsonData = json_encode($data);

	echo $jsonData;

?>



           	 