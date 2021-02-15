<?php 
	
	class Level extends Server{

		use Messages, Status;

		protected $dataTable;

		public function __construct(){

			parent::__construct();

			$this -> dataTable = "grados";

		}

		public function get_levels_number(){
			
				
				$loadData = $this -> search("select count(gr_id) as number from ".$this -> dataTable, 
					'',
					'No se encontraron registros de materias',
					'Error al obtener el numero de materias');
			
				if($loadData['status'] == 'done'){

					$data = mysqli_fetch_assoc($loadData['data']);
					
					return Status::get_status($loadData['status'],
											  $loadData['notice'],
											  $data['number']);

				}else{
					
					return Status::get_status($loadData['status'],
											  $loadData['notice'],
											  0);

				}

		
		}

		public function get_selectOptions(){
			
			$search = $this -> search("select gr_id, gr_nombre from ".$this -> dataTable,
									  'Mostrando grados',
									  'No hay grados registrados',
									  'Erros al cargar los grados');

			return Select_control::get_options($search, 'gr_id', 'gr_nombre');			

		}

		public function search_data($searchTxt = ''){

			if($searchTxt != ''){

				$searchTxt = $this -> data_cleaner($searchTxt);
				$noRecords = 0;

				$search = $this -> search("select * from  ".$this -> dataTable." where gr_nombre like '%$searchTxt%'", 
										  "",
										  "No se encontraron coincidencias con su busqueda",
										  'Error al buscar datos');

				if($search['status'] == 'done'){

					$noRecords = mysqli_num_rows($search['data']); 

					$rows = array();
					$c = 0;

					while($row = mysqli_fetch_assoc($search['data'])){
						
						$status = $row['gr_estado'];

						if($status == 'Activo'){
							
							$class = 'status-activeBtn fas fa-toggle-on';
						
						}else if($status == 'Inactivo'){
						
							$class = 'status-inactiveBtn fas fa-toggle-off';
						
						}else{

							$class = '';

						}

						$rows[$c] = array('id' => $row['gr_id'], 'tr' => "<tr>
											<td>$row[gr_nombre]</td>
											<td class='centrar-texto'>
												<button class='status-btn table-btn $class' id='status-btn$row[gr_id]' value='$row[gr_id]||$status' title='Click para modificar el estado de la materia'>
												</button	
											</td>
											<td class='centrar-texto'>
												<button class='update-btn fas fa-pencil-alt table-btn' value='$row[gr_id]' title='Click para abrir el formulario para editar materia'>
												</button>	
												<button class='del-btn fas fa-trash-alt table-btn' value='$row[gr_id]' title='Click para borrar materia'>
												</button>	
											</td>
									   	</tr>");

						$c++;
										
					}

					return  Status::get_status($search['status'], 
											   "Se encontraron $noRecords coincidencias con su busqueda", 
											   $rows);

				}else{

					return Status::get_multi_status($search['status'],
													'',
													$search['notice'],
													$search['notice'],
													'vacio'); 

				}

			}else{

					return Status::get_status('no-data', 'No ha ingresado su busqueda', 'vacio');
			}

		}

		public function add_data($data = ''){
	
			if(Data::loop_empty_data($data, '1')){

				$name = $this -> data_cleaner($data[0]);
				$status = $this -> data_cleaner($data[1]);
				$addDate = $this -> dateTime;
				
				$addData = $this -> crud("insert into ".$this -> dataTable." (gr_nombre, gr_estado, gr_fechaDeRegistro) values ('$name', '$status', '$addDate')", 
					'Datos registrado correctamente',
					'Error al registrar datos');
			
				if($addData['status'] == 'done'){
					
					return Status::get_status($addData['status'],
											  $addData['notice'],
											  '');

				}else{
					
					return Status::get_status($addData['status'],
											  $addData['notice'],
											  '');

				}

			}else{

				return Status::get_status('no-data',
											  	 'Hay campos vacios',
											     '');

			}

		}

		public function load_data_updateForm($id = ''){
	
			if(Data::empty_data($id)){

				$id = $this -> data_cleaner($id);
				
				$loadData = $this -> search("select * from ".$this -> dataTable." where gr_id='$id'", 
					'Datos cargados correctamente',
					'No hay datos registrados',
					'Error al cargar los datos para formulario');
			
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

			}else{

				return Status::get_status('no-data',
									      'Hay campos vacios',
										  '');

			}

		}

		public function set_data($data = ''){
			
			if(Data::loop_empty_data($data, '1')){

				$name = $this -> data_cleaner($data[0]);		
				$status = $this -> data_cleaner($data[1]);
				$id = $this -> data_cleaner($data[2]);
				$updateDate = $this -> dateTime;
				
				$update = $this -> crud("update ".$this -> dataTable." set gr_nombre='$name', gr_estado='$status', gr_fechaDeActualizacion='$updateDate' where gr_id='$id'", 
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

		public function update_status($status = '', $id = ''){

			$status = $this -> data_cleaner($status);

			$id = $this -> data_cleaner($id);

			switch ($status) {
				
				case 'Activo':
					
					$newStatus = 'Inactivo';	

				break;
				case 'Inactivo':
					
					$newStatus = 'Activo';

				break;
				
				default:

					$newStatus = 'Activo';
				
				break;

			}

			$update = $this -> crud("update ".$this -> dataTable." set gr_estado='".$newStatus."' where gr_id='".$id."'",
				          			"Estado actualizado correctamente",
				          			"Error al actualizar estado");

			if($update['status'] == 'done'){

				return Status::get_status($update['status'], $update['notice'], $newStatus);

			}else{

				return Status::get_status($update['status'], $update['notice'], '');

			}

		}

		public function del_data($id = ''){

			$id = $this -> data_cleaner($id);

			$del = $this -> crud("delete from ".$this -> dataTable." where gr_id='$id'",
				          		"Datos borrados correctamente",
				          		"Error al borrar datos");

			$multiDel = $this -> multiquery("update grupos set gru_grado='' where gru_grado='$id';
										delete materia set mat_grado='' where mat_grado='$id';
										delete from calificaiones where cal_grado='$id';",
				                 		'Datos eliminados correctamente',
				                 		'Error al eliminar datos');


			if($del['status'] == 'done' && $multiDel['status'] == 'done'){

				return Status::get_status($del['status'], $del['notice'], '');

			}else{

				return  Status::get_status($del['status'], $del['notice'].$multiDel['notice'], '');

			}


		}


	}
?>