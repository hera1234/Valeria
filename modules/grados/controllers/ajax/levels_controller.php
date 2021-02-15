<?php  
	
	session_start();

    require_once('../../../../classes/Data.php');
    require_once('../../../../classes/Messages.php');
    require_once('../../../../classes/Status.php');
    require_once('../../../../models/config.php');
    require_once('../../../../models/Server.php');
    require_once('../../../../models/Login.php');
 	require_once('../../models/Level.php');   

 	$level = new Level(); 
	
	if(isset($_POST["request"])){

			$data = json_decode($_POST['request']);

			switch ($data -> request) {

				case 'search-level':

					$search = $data -> data;

					$getData = $level -> search_data($search);
					
					$data = Status::get_status($getData['status'], $getData['notice'], $getData['data']);

				break;
				case 'add-signature':

					$add = $level -> add_data($data -> data);
				
					$data = Status::get_status($add["status"], $add["notice"], $add["data"]); 
							
				break;
				case 'get_data_setForm':

					$getData = $level -> load_data_updateForm($data -> id);
				
					$data = Status::get_status($getData["status"], $getData["notice"], $getData["data"]); 
							
				break;
				case 'set_data':

					$update = $level -> set_data($data -> data);
				
					$data = Status::get_status($update["status"], $update["notice"], $update["data"]);

				break;
				case 'update-status':

					$update = $level -> update_status($data -> data -> status, $data -> data -> id);
				
					$data = Status::get_status($update["status"], $update["notice"], $update["data"]);

				break;
				case 'del-data':

					$del = $level -> del_data($data -> id);
				
					$data = Status::get_status($del["status"], $del["notice"], $del["data"]);


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



           	 