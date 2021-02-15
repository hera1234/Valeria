<?php 
	
	class Group extends Server{

		use Messages, Status;

		protected $dataTable;

		public function __construct(){

			parent::__construct();

			$this -> dataTable = "grupos";

		}


		public function get_groupName($groupId){

				$getData = $this -> search("select gru_nombre from ".$this -> dataTable." where gru_id='$groupId'", 
					'',
					'No se econtro el nombre del grupo',
					'Error al obtener el nombre del grupo');
			
				if($getData['status'] == 'done'){

					$data = mysqli_fetch_assoc($getData['data']);
					
					return $data['gru_nombre'];

				}else{
					
					return 	$getData['notice'];
							
				}

		}

		public function get_groups_number(){
			
				
				$loadData = $this -> search("select count(gru_id) as number from ".$this -> dataTable, 
					'',
					'No se encontraron registros de grupos',
					'Error al obtener el numero de grupos');
			
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
			
			$search = $this -> search("select gru_id, gru_nombre from ".$this -> dataTable,
									  'Mostrando grupos',
									  'No hay grupos registrados',
									  'Erros al cargar los grupos');

			return Select_control::get_options($search, 'gru_id', 'gru_nombre');			

		}

		public function search_data($searchTxt = ''){

			if($searchTxt != ''){

				$searchTxt = $this -> data_cleaner($searchTxt);
				$noRecords = 0;

				$search = $this -> search("select *, grados.gr_nombre as levelName from  ".$this -> dataTable." left join grados on grados.gr_id=grupos.gru_grado  where gru_nombre like '%$searchTxt%'", 
										  "",
										  "No se encontraron coincidencias con su busqueda",
										  'Error al buscar datos');

				if($search['status'] == 'done'){

					$noRecords = mysqli_num_rows($search['data']); 

					$rows = array();

					$c = 0;

					while($row = mysqli_fetch_assoc($search['data'])){
						
						$status = $row['gru_status'];

						if($status == 'Activo'){
							
							$class = 'status-activeBtn fas fa-toggle-on';
						
						}else if($status == 'Inactivo'){
						
							$class = 'status-inactiveBtn fas fa-toggle-off';
						
						}else{

							$class = '';

						}

						$rows[$c] = array('id' => $row['gru_id'], 'tr' => "<tr>
											<td>$row[gru_nombre]</td>
											<td>$row[levelName]</td>
											<td class='centrar-texto'>
												<button class='status-btn table-btn  $class' id='status-btn$row[gru_id]' value='$row[gru_id]||$status' title='Click para modificar el estado del grupo'>
												</button	
											</td>
											<td class='centrar-texto'>
												<button class='update-btn table-btn  fas fa-pencil-alt' value='$row[gru_id]' title='Click para abrir el formulario para editar grupo'>
												</button>	
												<button class='del-btn fas table-btn fa-trash-alt' value='$row[gru_id]' title='Click para borrar grupo'>
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
				
				$addData = $this -> crud("insert into ".$this -> dataTable." (gru_nombre, gru_grado, gru_status, gru_fechaDeRegistro) values ('$name', '$level','$status', '$addDate')", 
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
				
				$loadData = $this -> search("select * from ".$this -> dataTable." where gru_id='$id'", 
					'Error al cargar los datos para formulario<br>',
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
				$level = $this -> data_cleaner($data[1]);
				$status = $this -> data_cleaner($data[2]);
				$id = $this -> data_cleaner($data[3]);
				$updateDate = $this -> dateTime;
				
				$update = $this -> crud("update ".$this -> dataTable." set gru_nombre='$name', gru_grado='$level', gru_status='$status', gru_fechaDeActualizacion='$updateDate' where gru_id='$id'", 
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

			$update = $this -> crud("update ".$this -> dataTable." set gru_status='".$newStatus."' where gru_id='".$id."'",
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

			$del = $this -> crud("delete from ".$this -> dataTable." where gru_id='$id'",
				          		"Datos borrados correctamente",
				          		"Error al borrar datos");

			$multiDel = $this -> multiquery("update alumnos set grupo='' where grupo='$id';
											delete from calificaiones where cal_grupo='$id';",
					                 		'Datos eliminados correctamente',
					                 		'Error al eliminar datos');

			if($del['status'] == 'done'){

				return Status::get_status($del['status'], $del['notice'], '');

			}else{

				return  Status::get_status($del['status'], $del['notice'].$multiDel['notice'], '');

			}

		}


	}
?>