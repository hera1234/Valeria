<?php

class Login extends server{

	private $dataTable;
	public $school;
	public $user;
	public $teacher; 

	public function __construct(){
	
		parent::__construct();
		
		$this -> dataTable = 'info_escuela';
		$this -> userType = '';
		$this -> school = null;//objeto School
		$this -> user = null;//objeto User
		$this -> teacher = null;//objeto Teacher

	}

	public function create_user_object(User $user = null){
	
		$this ->  user = $user;

	}

	public function create_school_object(School $school = null){
	
		$this -> school = $school;

	}

	public function create_teacher_object(Teacher $teacher = null){
	
		$this ->  teacher = $teacher;

	}

	public function login($user = '', $password = '', $userType = ''){

		if(!Data::empty_data($user) 
		   || !Data::empty_data($password)
		   || !Data::empty_data($userType)){
		
			return Messages::msg('Hay campos vacios <br> <a href="Index.php"><div class="nuevoIntento btnGen">Intentar de  Nuevo</div>',
								'info');
		
		}else{
				
			switch ($userType) {
			
				case 'admin':
					
					return $this -> user_login($user, $password);

				break;
				case 'prof':
				
					return $this -> teacher_login($user, $password);

				break;
				case 'alum':
				
					return false;

				break;
				
				default:
				
					return Messages::info_msg('No se reconoce el tipo de usuario');

				break;
			
			}

		}

	}
	
	protected function user_login($user, $password){
		
		if(!Data::empty_data($user) || !Data::empty_data($password)){
		
			return Messages::msg('Hay campos vacios <br> <a href="Index.php"><div class="nuevoIntento btnGen">Intentar de  Nuevo</div>',
								'info');
		
		}else{
		
			$user = $this -> data_cleaner($user);
			$password = $this -> data_cleaner($password);
			
			$search = $this -> search("select password, estado from usuarios where usuario='$user'",
									  "Error al comprobar usuario<br>");
	
			if($search["status"] == "no-data"){
	
				return Messages::msg('Su usuario no existe o ha sido eliminado <br> <a href="Index.php"><div class="nuevoIntento btnGen">Intentar de  Nuevo</div></a>', 
	 								'info');
	
			}else if($search["status"] == 'done'){

				$userData = mysqli_fetch_assoc($search["data"]); 

				if($userData['estado'] == 'Inactivo'){
	 
					return Messages::msg('Su usuario se encuentra desactivado consulte a su administrador<br> <a href="Index.php"><div  class="nuevoIntento btnGen">Intentar de Nuevo</div></a>',
								  'error');
	 
		 		}else{
		
					$hash = $userData['password'];

					$password = $this -> crypt_md5($password);
		
					if($password != $hash){

						return Messages::msg('Password incorrecto <br> <a href="Index.php"><div  class="nuevoIntento btnGen">Intentar de Nuevo</div></a>--',
											"info");

					}else{

						$this -> user -> get_user_data($user, $password); 	

						$_SESSION['userCA']['userData'] = $this -> user -> userData; 

						$this -> school -> get_school_data(); 	

						$_SESSION['userCA']['schoolData'] = $this -> school -> schoolData;

					
					return Messages::msg('Bienvenido:<br>'.$this -> user -> userData['name'].'<div class="loader"><img src="views/theme/img/ajax-loader.gif"></div><meta http-equiv="refresh" content="2;url=principal.php">', 
	 					          'success');
  

					}//$verify

				}
	
			}else{

				return Messages::msg($search["notice"],
											"error");
		
			}//num rows
	
		}//berificacion de campos vacios	
	
	}

	protected function teacher_login($user, $password){
		
		if(!Data::empty_data($user) || !Data::empty_data($password)){
		
			return Messages::msg('Hay campos vacios <br> <a href="Index.php"><div class="nuevoIntento btnGen">Intentar de  Nuevo</div>',
								'info');
		
		}else{
		
			$user = $this -> data_cleaner($user);
			$password = $this -> data_cleaner($password);
			
			//buscar usuario
			$search = $this -> teacher -> get_by_userAndStatus($user);
	
			if($search["status"] == "no-data"){
	
				return Messages::msg('Su usuario no existe o ha sido eliminado <br> <a href="Index.php"><div class="nuevoIntento btnGen">Intentar de  Nuevo</div></a>', 
	 								'info');
	
			}else if($search["status"] == 'done'){

				$userData = mysqli_fetch_assoc($search["data"]); 

				if($userData['estado'] == 'Inactivo'){
	 
					return Messages::msg('Su usuario se encuentra desactivado consulte a su administrador<br> <a href="Index.php"><div  class="nuevoIntento btnGen">Intentar de Nuevo</div></a>',
								  'error');
	 
		 		}else{
		
					$hash = $userData['password'];
					$password = $this -> crypt_md5($password);
		
					if($password != $hash){

						return Messages::msg('Password incorrecto <br> <a href="Index.php"><div  class="nuevoIntento btnGen">Intentar de Nuevo</div></a>--',
											"info");

					}else{

	 						
						$this -> teacher -> get_teacher_data($user, $password); 	

						$_SESSION['userCA']['teacherData'] = $this -> teacher -> teacherData; 

						$this -> school -> get_school_data(); 	

						$_SESSION['userCA']['schoolData'] = $this -> school -> schoolData;

					
					return Messages::msg('Bienvenido:<br>'.$this -> teacher -> teacherData['name'].'<div class="loader"><img src="views/theme/img/ajax-loader.gif"></div><meta http-equiv="refresh" content="2;url=principal.php">', 
	 					          'success');

					}

				}
	
			}else{

				return Messages::msg($search["notice"],
											"error");
		
			}
	
		}
	
	}

	private function user_verify($userTypeLog = '', $userType = ''){

		if($userTypeLog == $userType){

			return true;

		}else{

			return false;

		}
	
	}	
	
	public function is_admin($userType = ''){

		return $this -> user_verify('admin', $userType);
		
	}

	public function is_teacher($userType = ''){
			
		return $this -> user_verify('prof', $userType);

	}
	
	public function pass_verify($password,$hash){
		$match = password_verify($password, $hash);
		return $match;
	}
	
	public function logout_user($direction = ''){
		
		if(isset($_SESSION['userCA'])){
		
			session_destroy();
			header($direction);
		
		}else{
		
			return 'Error en logout';
		
		}

	}	
	
	public function session_verify(){

		if(isset($_SESSION['userCA'])){
		
			return true;
		
		}else{
		
			return false;
		
		}
	
	}

	public function get_menu(){

		$school = $_SESSION['userCA']['schoolData'];
		
		$schoolName = $school['name'];
		
		$user = $this -> get_userData_byUserType();

		$userName = $user['name'];
		$userType = trim($user['userType']);

		switch ($userType) {
			
			case 'admin':
			
					require_once('views/theme/inc/menu/m_admin.php');

			break;
			case 'prof':

					require_once('views/theme/inc/menu/m_teacher.php');

			break;	
			default:
				
					require_once('views/theme/inc/menu/m_gen.php');

			break;
		
		}

	}

	public function get_userData_byUserType(){
		
		if(isset($_SESSION['userCA']['userData'])){

			return $_SESSION['userCA']['userData'];
	
		}else if(isset($_SESSION['userCA']['teacherData'])){
	
			return $_SESSION['userCA']['teacherData'];
	
		}else{
			return false;
		}	

	}

}

?>