<?php 

	class Server{
		
		use Status, Messages;
		
		protected $connection;
		private $db;
		private $host;
		private $user;
		private $password;
		private $status;

		public function __construct(){	
			
			$this->status = "none";
			
			$this -> db = DB;
			$this -> host = HOST;
			$this -> user = USER;
			$this -> password = PASSWORD;

			$this -> connection = mysqli_connect($this->host, $this->user, $this->password, $this->db) or die ("Error al conectar con servidor".mysqli_error($this->connection));

			$this -> dateTime = date("Y/m/d H:i:s");
			$this -> date = date("Y/m/d");
			$this -> time = date("H:i:s");

		}

		protected function search($query = "", 
			                      $doneMsg  = "", 
			                      $noDataMsg  = "",
			                      $errorMsg  = ""){

			//buscar registros

			if($query == ""){
				
				$data  = $this -> status_query("no-data", "No ha introducido su consulta");				

			}else{

				if($doneMsg == ""){

					$doneMsg == "Consulta exitosa"; 

				}
				if($noDataMsg == ""){

					$errorMsg = "Error en conuslta";

				}
				if($errorMsg == ""){

					$errorMsg = "Error en conuslta";

				}

				$search = mysqli_query($this->connection, $query) or die ($errorMsg.mysqli_error($this->connection));
				
				if($search == true){

					$num_rows = mysqli_num_rows($search);
			
					if($num_rows > 0){

						$data  = Status::get_status("done", $doneMsg, $search);

					}else{

						$data  = Status::get_status("no-data", $noDataMsg, "vacio");

					}

				}else{

					$data  = Status::get_status("error", $errorMsg, "error");

				}

			}

			return $data; 
		
		}

		protected function crud($query = "", 
			                    $doneMsg ="",
			                    $errorMsg = ""){

			//realizar consultas como insert, update, delete

			//verificar si se ha introducido consulta
			if($query == ''){

				$data = Status::get_status("done", "No ha introducido su consulta");

			}else{

				if($doneMsg == ""){

					$doneMsg == "Consulta exitosa"; 

				}
				if($errorMsg == ""){

					$errorMsg = "Error en conuslta";

				}

				$crud = mysqli_query($this->connection, $query) or die ($errorMsg.mysqli_error($this -> connection));
	
				if($crud){

					$data = Status::get_status("done", $doneMsg);

				}else{

					$data = Status::get_status("error", $errorMsg);

				}
				
			}

			return $data;

		}

		protected function multiquery($query = "", 
									  $doneMsg  = "", 
				                      $noDataMsg  = "", 
				                      $errorMsg  = ""){

			//buscar registros

			if($query == ""){
				
				$data  = Status::get_status("no-data", "No ha introducido su consulta");				

			}else{

				
				if($doneMsg == ""){

					$doneMsg == "Consulta exitosa"; 

				}
				if($noDataMsg == ""){

					$noDataMsg = "Sin datos";

				}
				if($errorMsg == ""){

					$errorMsg = "Error en consulta";

				}

				$data = '';

				try{

					$search = mysqli_multi_query($this -> connection, $query);				

					if($results = mysqli_more_results($this -> connection)){

						mysqli_next_result($this -> connection);						

						$data = mysqli_store_result($this -> connection);

						$data  = Status::get_status("done", $doneMsg, $data);

					}else{

						$data  = Status::get_status('no-data', $noDataMsg, "Sin datos");

					}
				
				
				}catch(mysqli_sql_exception $e){

			    	$data = Status::get_status('error', $errorMsg.' | '.$e -> getMessage(), "Error");
			
				}

			}

			return $data; 
		
		}

		public function get_inserted_id(){

			return mysqli_insert_id($this -> connection);

		}

		public function data_cleaner($data){

			//limpiar datos a ingresar en la base de datos

			$data_clean = htmlspecialchars($data);
			 
			$data_clean = mysqli_real_escape_string($this->connection, $data);
			
			return $data_clean;	
		
		}

		protected function crypt_md5($password){
			
			//encriptar con md5
			$md5crypt = md5($password);
			
			return $md5crypt;

		}


		protected function crypt_data($data){
		 	
		 	//encriptar con password_hash

		 	$timeTarget = 0.05;//50 milisegundos 
			
			$coste = 8;
			
			do {
				
				$coste++;
				$inicio = microtime(true);
				$opciones["cost"]=$coste;
				$hash=password_hash($data, PASSWORD_BCRYPT,['cost'=>$coste]);//password_hash(contraseña,algoritmo para crear el hash,array asociativo de opciones);
				$fin = microtime(true);
			
			}while (($fin - $inicio) < $timeTarget);
			
			return $hash;	
		
		}
		
		public function pass_verify($data, $hash){
			
			//verificar contraseña correcta

			$match=password_verify($data, $hash);
			
			return $match;
		
		}

		public function verify_expired_time($date = "", $hour = ""){

			//fecha de expiracion
			$dateTimeExp = strtotime($date." ".$hour);
            
            //fecha actual
            $dateTime = strtotime(date("d-m-Y H:i:s", time()));
           
            if($dateTime < $dateTimeExp){

            	return true;

            }else{

            	return false;

            }

		}
	
	}
?>	