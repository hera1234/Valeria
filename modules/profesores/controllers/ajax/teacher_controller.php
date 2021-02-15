<?php  
	
	session_start();

    require_once('../../../../classes/Data.php');
    require_once('../../../../classes/Messages.php');
    require_once('../../../../classes/Status.php');
    require_once('../../../../models/config.php');
    require_once('../../../../models/Server.php');
    require_once('../../../../models/Login.php');
 	require_once('../../models/Teacher.php');   

 	$teacher = new Teacher(); 
	
	if(isset($_POST["request"])){

			$data = json_decode($_POST['request']);

			switch ($data -> request) {

				case 'search-teacher':

					$search = $data -> data;

					$getData = $teacher -> search_data($search);
					
					$data = Status::get_status($getData['status'], $getData['notice'], $getData['data']);

				break;
				case 'add-teacher':

					$add = $teacher -> add_data($data -> data);
				
					$data = Status::get_status($add["status"], $add["notice"], $add["data"]); 
							
				break;
				case 'get-teacherSignatures':

					$getData = $teacher -> get_teacher_signatures($data -> teacherId);
				
					$data = Status::get_status($getData["status"], $getData["notice"], $getData["data"]); 
							
				break;
				case 'load-selectSignatures':

					//cargar las materias del grado seleccionado
					$getData = $teacher -> load_teacher_signatures($data -> levelId);
				
					$data = Status::get_status($getData["status"], $getData["notice"], $getData["data"]); 
							
				break;
				case 'add-teacherSignature':

					$getData = $teacher -> add_teacher_signatures($data -> teacherId, $data -> signatureId, $data -> groupId, $data -> levelId);
				
					$data = Status::get_status($getData["status"], $getData["notice"], $getData["data"]); 
							
				break;
				case 'del-signatureOfList':

					$getData = $teacher -> del_teacher_signature($data -> teacherId, $data -> signatureId);
				
					$data = Status::get_status($getData["status"], $getData["notice"], $getData["data"]); 
							
				break;
				case 'get-teacherInfo':

					$getData = $teacher -> get_teacher_info($data -> teacherId);
				
					$data = Status::get_status($getData["status"], $getData["notice"], $getData["data"]); 
							
				break;
				case 'get_data_setForm':

					$getData = $teacher -> load_data_updateForm($data -> idTeacher);
				
					$data = Status::get_status($getData["status"], $getData["notice"], $getData["data"]); 
							
				break;
				case 'set_data':

					if($data -> data[2] == ''){

						$data -> data[2] = 'vacio';

					}

					$update = $teacher -> set_data($data -> data);
				
					$data = Status::get_status($update["status"], $update["notice"], $update["data"]);

				break;
				case 'update-status':

					$update = $teacher -> update_status($data -> data -> status, $data -> data -> id);
				
					$data = Status::get_status($update["status"], $update["notice"], $update["data"]);

				break;
				case 'del-data':

					$del = $teacher -> del_data($data -> idTeacher);
				
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



           	 