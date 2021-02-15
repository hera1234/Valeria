<?php 
	
	class Student extends Server{

		use Messages, Status;

		private $laDataTable;

		public function __construct(){

			parent::__construct();

			$this -> laDataTable = 'lista_alumnos'; 

		}

		public function search_data($searchTxt = ''){

			if($searchTxt != ''){

				$searchTxt = $this -> data_cleaner($searchTxt);

				$search = $this -> search("select *, alumnos.id as studentId, alumnos.nombre as studentName, alumnos.estado as status from alumnos left join grupos on gru_id=alumnos.grupo where alumnos.nombre like '%$searchTxt%'  or matricula='$searchTxt'");

				if($search['status'] == 'done'){

					$noRecords = mysqli_num_rows($search['data']); 

					$rows = array();

					$c = 0;

					while($row = mysqli_fetch_assoc($search['data'])){


						$status = $row['status'];

						if($status == 'Activo'){
							
							$class = 'status-activeBtn fas fa-toggle-on';
						
						}else if($status == 'Inactivo'){
						
							$class = 'status-inactiveBtn fas fa-toggle-off';
						
						}else{

							$class = '';

						}
						
						$rows[$c] = array('id' => $row['studentId'], 'tr' => "<tr>
																				<td>$row[studentName]</td>
																				<td>$row[matricula]</td>
																				<td>$row[gru_nombre]</td>
																				<td class='centrar-texto'>
																					<button value='$row[studentId]' class='show-signaturesBtn table-btn t-show-btn fas fa-eye' title='Click para ver las materias del alumno'></button>
																				</td>
																				<td class='centrar-texto'>
																					<button class='status-btn table-btn $class' id='status-btn' value='$row[studentId]||$status' title='Click para modificar el estado del alumno'>
																					</button	
																				</td>
																				<td class='centrar-texto'>
																					<button class='update-btn table-btn fas fa-pencil-alt' value='$row[studentId]' title='Click para abrir el formulario para editar alumno'>
																					</button>
																					<button class='del-btn table-btn far fa-trash-alt' value='$row[studentId]' title='Click para borrar alumno'>
																					</button>	
																				</td>
																		   	</tr>");
					
						$c++;

					}

					return  Status::get_status($search['status'], 
											   "Busqueda exitosa. Se encontraron $noRecords coincidencias con su busqueda", 
											   $rows);

				}else{

					return Status::get_multi_status($search['status'],
													'',
													'No se encontraron coincidencias con su busqueda',
													'Error al buscar alumnos',
													'vacio'); 

				}

			}else{

					return Status::get_status('no-data', 'No ha ingresado su busqueda', 'vacio');
			}

		}

		public function add_data($data = ''){
	
			if(Data::loop_empty_data($data, '1')){

				$name = $this -> data_cleaner($data[0]);
				$bornDate = $this -> data_cleaner($data[1]);
				$matricula = $this -> data_cleaner($data[2]);
				$fatherName = $this -> data_cleaner($data[3]);
				$motherName = $this -> data_cleaner($data[4]);
				$address = $this -> data_cleaner($data[5]);
				$tel = $this -> data_cleaner($data[6]);
				$group = $this -> data_cleaner($data[7]);
				$status = $this -> data_cleaner($data[8]);
				$addDate = $this -> dateTime;
				$userType= 'alum';

				//registro de datos en tabla alumnos
				$addStudent = $this -> crud("insert into alumnos (nombre, fechaDeNacimiento, direccion, telefono, padre, madre, grupo, estado, matricula, tipoUsuario, al_fechaDeRegistro) values ('$name', '$bornDate', '$address', '$tel', '$fatherName', '$motherName', '$group', '$status', '$matricula', '$userType', '$addDate')", 
					'Alumno registrado correctamente',
					'Error al registrar el alumno');
			
				if($addStudent['status'] == 'done'){

					return Status::get_status($addStudent['status'],
											  $addStudent['notice'],
											  '');


				}else{
					
					return Status::get_status($addStudent['status'],
											  $addStudent['notice'],
											  '');

				}

			}else{

				return Status::get_status('no-data',
											  	 'Hay campos vacios',
											     '');

			}

		}

		//metodo para solicitar los datos del alumno para llenar  formulario
		private function get_data_updateForm($studentId = ''){

			if(Data::empty_data($studentId)){

				$idStudent = $this -> data_cleaner($studentId);
				
				$loadData = $this -> search("select * from alumnos where alumnos.id='$studentId'", 
										    'Datos cargados correctamente',
											'No hay registros del alumno',
											'Error al cargar los datos del alumno para formulario');
			
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
									      'Falta identificador de alumno',
										  '');

			}			

		}

		public function load_data_updateForm($studentId = ''){
	
			if(Data::empty_data($studentId)){
				
				//solicitar los datos del alumno para llenar el formuario
				$loadData = $this -> get_data_updateForm($studentId);
			
				if($loadData['status'] == 'done'){
					
					//mandar los datos del alumno
					return $loadData;

				}else{
					
					return Status::get_status($loadData['status'],
											  $loadData['notice'],
											  '');
				}

			}else{

				return Status::get_status('no-data',
									      'Falta id de alumno para cargar los datos en formulario',
										  '');

			}

		}

		public function set_data($data = ''){
			
			if(Data::loop_empty_data($data, '1')){

				$name = $this -> data_cleaner($data[0]);
				$bornDate = $this -> data_cleaner($data[1]);
				$matricula = $this -> data_cleaner($data[2]);
				$fatherName = $this -> data_cleaner($data[3]);
				$motherName = $this -> data_cleaner($data[4]);
				$address = $this -> data_cleaner($data[5]);
				$tel = $this -> data_cleaner($data[6]);
				$group = $this -> data_cleaner($data[7]);
				$status = $this -> data_cleaner($data[8]);
				$id = $this -> data_cleaner($data[9]);
				$userType = 'alum';
				$updateDate = $this -> dateTime;
				
				//actualizar tabla alumnos
				$setStudent = $this -> crud('update alumnos set nombre="'.$name.'", fechaDeNacimiento="'.$bornDate.'", direccion="'.$address.'", telefono="'.$tel.'", padre="'.$fatherName.'" , madre="'.$motherName.'", grupo="'.$group.'", estado="'.$status.'", matricula="'.$matricula.'", tipoUsuario="'.$userType.'", al_fechaDeActualizacion="'.$updateDate.'" where id="'.$id.'"', 
					'Alumno actualizado correctamente',
					'Error al actualizar alumno primer consulta');
			
				if($setStudent['status'] == 'done'){

					return Status::get_status($setStudent['status'],
												  $setStudent['notice'],
												  '');
				}else{
					
					return Status::get_status($setStudent['status'],
											  $setStudent['notice'],
											  '');

				}

			}else{

				return Status::get_status('no-data',
										  'Hay campos vacios',
										  '');

			}


		}

		public function update_status($status = '', $idStudent = ''){

			$status = $this -> data_cleaner($status);

			$id = $this -> data_cleaner($idStudent);

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

			$update = $this -> crud("update alumnos set estado='".$newStatus."' where id='".$id."'",
				         	 		'Estado actualizado correctamente',
				          			 'Error al actualizar el estado del alumno');

			if($update['status'] == 'done'){

				return Status::get_status($update['status'], $update['notice'], $newStatus);

			}else{

				return Status::get_status($update['status'], $update['notice'], '');

			}

		}

		public function del_data($id = ''){


			$id = $this -> data_cleaner($id);
					
			$del = $this -> crud("delete from alumnos where id='$id'",
					             'Alumno eliminado correctamente',
					             'Error al eliminar el alumno');

			if($del['status'] == 'done'){

				$delCali = $this -> crud("delete from calificaciones where cal_alumno='$id'",
					                 	'Alumno eliminado correctamente en calificaciones',
					                 	'Error al eliminar el alumno en calificaciones');

				if($delCali['status'] == 'done'){
					
					return Status::get_status($del['status'], $del['notice'], '');

				}else{

					return Status::get_status($del['status'], $del['notice'].$delCali['notice'], '');					

				}

			}else{

				return  Status::get_status($del['status'], $del['notice'], '');

			}


		}

		public function get_signatures($studentId = ''){

			//cargar las materias correspondientes al alumno seleccionado
			if($studentId != ''){

				$searchTxt = $this -> data_cleaner($studentId);

				$search = $this -> search("select alumnos.nombre as studentName, mat_nombre as signatureName, gr_nombre as levelName, profesores.nombre as teacherName, gru_nombre as groupName from alumnos left join materias_profesor on mprof_grupo=alumnos.grupo left join materia on mat_id=mprof_materia left join grados on mat_grado=gr_id  left join grupos on gru_id=mprof_grupo left join profesores on profesores.id=mprof_profesor where alumnos.id='$studentId' and alumnos.grupo!='null'");

				if($search['status'] == 'done'){

					$noRecords = mysqli_num_rows($search['data']); 

					$data = array();
					
					$i = 0;

					while($row = mysqli_fetch_assoc($search['data'])){
						
						$data[$i] = array('groupName' => $row['groupName'], 
										  'levelName' => $row['levelName'], 
										  'signatureName' => $row['signatureName'],
										  'teacherName' => $row['teacherName']);
						
						$i++;

					}

					return  Status::get_status($search['status'], 
											   "Se encontraron $noRecords coincidencias con su busqueda", 
											   $data);

				}else{

					return Status::get_multi_status($search['status'],
													'',
													'No se encontraron coincidencias con su busqueda',
													'Error al buscar profesores',
													'vacio'); 

				}

			}else{

					return Status::get_status('no-data', 'No ha ingresado su busqueda', 'vacio');
			}

		}		


	}

?>