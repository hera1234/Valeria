<?php 
	
	class School extends Server{

		use Messages, Status;

		public function __construct(){

			parent::__construct();

			$this -> dataTable = "info_colegio";

			$this -> schoolData = array('id' => 'vacio',
					            'name' => 'vacio',
				                'address' => 'vacio',
				                'city' => 'vacio',
				                'telephone' => 'vacio',
				                'country' => 'vacio',
				                'web' => 'vacio',
				                'email' => 'vacio',
				                'addDate' => 'vacio',
				                'setDate' => 'vacio');


		}

		public function get_school_data(){

			//obtener los datos del colegio
			$search = $this -> search("select * from  ".$this -> dataTable, 
									  "",
									  "No se encontraron datos",
									  'Error al buscar datos');

			if($search['status'] == 'done'){

				$data = mysqli_fetch_assoc($search['data']);

				$this -> schoolData['id'] = $data['id'];
				$this -> schoolData['name'] = $data['nombre'];
                $this -> schoolData['address'] = $data['direccion'];
                $this -> schoolData['city'] = $data['ciudad'];
                $this -> schoolData['telephone'] = $data['tel'];
                $this -> schoolData['country'] = $data['pais'];
                $this -> schoolData['web'] = $data['web'];
                $this -> schoolData['email'] = $data['correo'];
                $this -> schoolData['addDate'] = $data['ic_fechaDeRegistro'];
                $this -> schoolData['setDate'] = $data['ic_fechaDeActualizacion'];


			}

		}

		public function get_set_date(){

			//obtener la fecha de actualizacion
			$search = $this -> search("select ic_fechaDeActualizacion from  ".$this -> dataTable, 
										  "",
										  "No se encontro fecha de actualizacion",
										  'Error al buscar fecha de actualizacion');

			if($search['status'] == 'done'){

				$date = mysqli_fetch_assoc($search['data']);

				return Status::get_status('done', $search['notice'], $date['ic_fechaDeActualizacion']);

			}else{

				return Status::get_status($search['status'], 
										  '', 
										  $search['notice'],
										  $search['notice'], 
										  '00/00/00 00:00:00');
			}	

		}

		public function load_data_updateForm(){
	
				
			$loadData = $this -> search("select * from ".$this -> dataTable, 
				'Datos cargados correctamente',
				'No hay datos del colegio',
				'Error al cargar los datos colegio para formulario');
		
			if($loadData['status'] == 'done'){

				$data = mysqli_fetch_assoc($loadData['data']);
				
				return Status::get_status($loadData['status'],
										  $loadData['notice'],
										  $data);

			}else{
				
				return Status::get_status($loadData['status'],
										  $loadData['notice'],
										  '');

			}

		}

		public function set_data($data = ''){
			
			if(Data::loop_empty_data($data, '1')){

				$name = $this -> data_cleaner($data[0]);		
				$country = $this -> data_cleaner($data[1]);		
				$city = $this -> data_cleaner($data[2]);		
				$address = $this -> data_cleaner($data[3]);		
				$email = $this -> data_cleaner($data[4]);		
				$tel = $this -> data_cleaner($data[5]);		
				$webSite = $this -> data_cleaner($data[6]);
				$id = $this -> data_cleaner($data[7]);
				$updateDate = $this -> dateTime;
				
				$update = $this -> crud("update ".$this -> dataTable." set nombre='$name', direccion='$address', pais='$country', ciudad='$city', tel='$tel', web='$webSite', correo='$email', ic_fechaDeActualizacion='$updateDate' where id='$id'", 
										"Datos actualiza los correctamente",
										"Error al actualizar datos");
			
				if($update['status'] == 'done'){
					
					return Status::get_status($update['status'],
											  $update['notice'],
											  '');

				}else{
					
					return Status::get_status($update['status'],
											  $update['notice'],
											  '');

				}

			}else{

				return Status::get_status('no-data',
											  	 'Hay campos vacios',
											     '');

			}


		}

	}
?>