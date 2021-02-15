<?php 
	
	class Signature extends Server{

		use Messages, Status, Select_control;

		public $teacherId;
		private $dataTable;

		public function __construct(){

			parent::__construct();

			$this -> dataTable = "materia";
			$this -> teacherId = '';

		}

		public function get_signatures_number(){
			
				
				$loadData = $this -> search("select count(mat_id) as number from ".$this -> dataTable, 
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

		//metodo para cargar materias en un select 
		public function get_options_byTeacher($teacherId = ''){

			$search = $this -> search("select mat_id, mat_nombre from ".$this -> dataTable." left join lista_de_materias on lm_materia=mat_id where lm_profesor='".$teacherId."'",
									  'Mostrando materias',
									  'No hay materias registrados',
									  'Erros al cargar las materias');

			return Select_control::get_options($search, 'mat_id', 'mat_nombre');		
		
		}

		//metodo para buscar materias por profesor
		public function search_data_byTeacher($searchTxt = '', $teacherId){

			if($searchTxt != ''){

				$searchTxt = $this -> data_cleaner($searchTxt);
				$teacherId = $this -> data_cleaner($teacherId);
				
				$search = $this -> search("select *, salones.nombre as crName, grados.gr_nombre as levelName, profesores.nombre as teacherName from  ".$this -> dataTable." left join salones on salones.id=mat_salon left join grados on grados.id=mat_grado left join profesores on profesores.id=mat_profesor where mat_nombre like '%$searchTxt%' and mat_profesor='teacherId'", 
										  "",
										  "No se encontraron coincidencias con su busqueda",
										  'Error al buscar datos');

				return $this -> get_data_table($search);

			}else{

					return Status::get_status('no-data', 'No ha ingresado su busqueda', 'vacio');
			}

		}

		//metodo para buscar materias en general
		public function search_data($searchTxt = ''){

			if($searchTxt != ''){

				$searchTxt = $this -> data_cleaner($searchTxt);
				
				$search = $this -> search("select *, grados.gr_nombre as levelName from  ".$this -> dataTable." left join grados on grados.gr_id=mat_grado where mat_nombre like '%$searchTxt%'", 
										  "",
										  "No se encontraron coincidencias con su busqueda",
										  'Error al buscar datos');

				return $this -> get_data_table($search);
				
			}else{

					return Status::get_status('no-data', 'No ha ingresado su busqueda', 'vacio');
			}

		}

		//metodo para crear la tabla de materias 
		public function get_data_table($search = ''){

			if($search != ''){

				$noRecords = 0;

				if($search['status'] == 'done'){

					$noRecords = mysqli_num_rows($search['data']); 

					$rows = array();

					$c = 0;

					while($row = mysqli_fetch_assoc($search['data'])){
						
						$status = $row['mat_estado'];

						if($status == 'Activo'){
							
							$class = 'status-activeBtn fas fa-toggle-on';
						
						}else if($status == 'Inactivo'){
						
							$class = 'status-inactiveBtn fas fa-toggle-off';
						
						}else{

							$class = '';

						}

						$rows[$c] = array('id' => $row['mat_id'], 'tr' => "<tr>
											<td>$row[mat_nombre]</td>
											<td>$row[levelName]</td>
											<td class='centrar-texto'>
												<button class='status-btn $class table-btn' id='status-btn$row[mat_id]' value='$row[mat_id]||$status' title='Click para modificar el estado de la materia'>
												</button	
											</td>
											<td class='centrar-texto'>
												<button class='update-btn fas fa-pencil-alt table-btn' value='$row[mat_id]' title='Click para abrir el formulario para editar materia'>
												</button>	
												<button class='del-btn fas fa-trash-alt table-btn' value='$row[mat_id]' title='Click para borrar materia'>
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
				$level = $this -> data_cleaner($data[1]);
				$status = $this -> data_cleaner($data[2]);
				$addDate = $this -> dateTime;
				
				$addData = $this -> crud("insert into ".$this -> dataTable." (mat_nombre, mat_grado, mat_estado, mat_fechaDeRegistro) values ('$name', '$level', '$status', '$addDate')", 
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
				
				$loadData = $this -> search("select * from ".$this -> dataTable." where mat_id='$id'", 
					'Datos cargados correctamente',
					'No hay datos del usuario',
					'Error al cargar los datos de la materia para formulario');
			
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
				$level = $this -> data_cleaner($data[1]);
				$status = $this -> data_cleaner($data[2]);
				$id = $this -> data_cleaner($data[3]);
				$updateDate = $this -> dateTime;
				
				$update = $this -> crud("update ".$this -> dataTable." set mat_nombre='$name',mat_grado='$level', mat_estado='$status', mat_fechaDeActualizacion='$updateDate' where mat_id='$id'", 
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

			$update = $this -> crud("update ".$this -> dataTable." set mat_estado='".$newStatus."' where mat_id='".$id."'",
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

			$del = $this -> crud("delete from ".$this -> dataTable." where mat_id='$id'",
				          		"Datos borrados correctamente",
				          		"Error al borrar datos");

			$delM = $this -> crud("delete from materias_profesor where mprof_id='$id'",
	          		"Datos borrados correctamente",
	          		"Error al borrar datos");

			if($del['status'] == 'done'){

				return Status::get_status($del['status'], $del['notice'], '');

			}else{

				return  Status::get_status($del['status'], $del['notice'].$delM['notice'], '');

			}


		}


	}
?>