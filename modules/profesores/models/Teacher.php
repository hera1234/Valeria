<?php 
	
	class Teacher extends Server{

		use Messages, Status;

		protected $dataTable;
		protected $lpDataTable;

		public function __construct(){

			parent::__construct();

			$this -> dataTable = 'profesores';
			$this -> lpDataTable = 'lista_profesores';

			$this -> teacherData = array('id' => 'vacio',
								    'user' => 'vacio',
					                'name' => 'vacio',
					                'dateBorn' => 'vacio',
					                'address' => 'vacio',
					                'telephone' => 'vacio',
					                'email' => 'vacio',
					                'userType' => 'vacio',
					                'status' => 'vacio');
			//objetos
			$this -> group = null;

		}

		public function get_group_instance($group = null){
		
			$this -> group = $group;
		
		}

		public function get_teacher_data($user = '', $password = ''){

			$search = $this -> search("select id, usuario, nombre, fechaNacimiento, direccion, telefono, email, tipoUsuario, estado from profesores where usuario='$user' and password='$password'",
									   "Datos obtenidos correctamente",
									   "Error al cargar los datos del usuario");
			if($search['status'] == 'done'){

				$data = mysqli_fetch_assoc($search['data']);

				$this -> teacherData['id'] = $data['id'];
				$this -> teacherData['user'] = $data['usuario'];
                $this -> teacherData['name'] = $data['nombre'];
                $this -> teacherData['dateBorn'] = $data['fechaNacimiento'];
                $this -> teacherData['address'] = $data['direccion'];
                $this -> teacherData['telephone'] = $data['telefono'];
                $this -> teacherData['email'] = $data['email'];
                $this -> teacherData['userType'] = $data['tipoUsuario'];
                $this -> teacherData['status'] = $data['estado'];

			}

		}

		public function get_by_userAndStatus($user = ''){

			return $search = $this -> search("select password, estado from profesores where usuario='$user' and estado='Activo'",
											 "Usuario encontrado",
											 "Usuario no encontrado",
											 "Error al buscar usuario");	

		}

		public function get_selectOptions(){
			
			$search = $this -> search("select id, nombre from ".$this -> dataTable,
									  'Mostrando grados',
									  'No hay profesores registrados',
									  'Erros al cargar los grados');

			return Select_control::get_options($search, 'id', 'nombre');		

		}

		public function search_data($searchTxt = ''){

			if($searchTxt != ''){

				$searchTxt = $this -> data_cleaner($searchTxt);

				$search = $this -> search("select * from  ".$this -> dataTable." where nombre like '%$searchTxt%'");

				if($search['status'] == 'done'){

					$noRecords = mysqli_num_rows($search['data']); 

					$rows = array();

					$c = 0;

					while($row = mysqli_fetch_assoc($search['data'])){
						
						$status = $row['estado'];

						if($status == 'Activo'){
							
							$class = 'status-activeBtn fas fa-toggle-on';
						
						}else if($status == 'Inactivo'){
						
							$class = 'status-inactiveBtn fas fa-toggle-off';
						
						}else{

							$class = '';

						}

						$rows[$c] = array('id' => $row['id'], 'tr' => "<tr>
																				<td>$row[usuario]</td>
																				<td>$row[nombre]</td>
																				<td class='centrar-texto'>
																					<button class='far fa-eye table-btn t-show-btn signatures-listBtn' id='signatures-listBtn$row[id]' value='$row[id]' title='Click para ver las materias del profesor'>
																					</button>
																					<button class='add-signaturesBtn table-btn t-add-btn fas fa-plus-square' id='add-signaturesBtn$row[id]' value='$row[id]' title='Click para ver las materias del profesor'>
																					</button>
																					
																				</td>
																				<td class='centrar-texto'>
																					<button class='far fa-eye table-btn info-btn t-show-btn' id='info-btn$row[id]' value='$row[id]' title='Click para ver la informacion del profesor'>
																					</button>
																				</td>
																				<td class='centrar-texto'>
																					<button class='status-btn table-btn $class' id='status-btn$row[id]' value='$row[id]||$status' title='Click para modificar el estado del profesor'>
																					</button>	
																				</td>
																				<td class='centrar-texto'>
																					<button class='update-btn table-btn fas fa-pencil-alt' value='$row[id]' title='Click para abrir el formulario para editar profesores'>
																					</button>	
																					<button class='del-btn fas table-btn fa-trash-alt' value='$row[id]' title='Click para borrar profesor'>
																					</button
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
													'No se encontraron coincidencias con su busqueda',
													'Error al buscar profesores',
													'vacio'); 

				}

			}else{

					return Status::get_status('no-data', 'No ha ingresado su busqueda', 'vacio');
			}

		}
		
		public function get_teacher_signatures($id = ''){

			//cargar la lista de materias que tiene asignadas el profesor
			if($id != ''){

				$searchTxt = $this -> data_cleaner($id);

				$search = $this -> search("select mat_id, mprof_id, mat_nombre as signatureName, gr_nombre as levelName, gru_nombre as groupName from materias_profesor inner join materia on materia.mat_id=mprof_materia left join grados on grados.gr_id=mat_grado left join grupos on gru_id=mprof_grupo where mprof_profesor='$id'");

				if($search['status'] == 'done'){

					$noRecords = mysqli_num_rows($search['data']); 

					$rows = array();

					$c = 0;

					while($row = mysqli_fetch_assoc($search['data'])){
						
						$rows[$c] = array('id' => $row['mat_id'], 'tr' => "<tr>
											<td>$row[signatureName]</td>
											<td>$row[levelName]</td>
											<td>$row[groupName]</td>	
											<td class='centrar-texto'>
												<button class='quit-btn table-btn del-btn fas fa-trash-alt' value='$row[mprof_id]||$row[mat_id]' title='Click para eliminar la materias de la lista de materias'>
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
													'No se encontraron coincidencias con su busqueda',
													'Error al buscar profesores',
													'vacio'); 

				}

			}else{

					return Status::get_status('no-data', 'No ha ingresado su busqueda', 'vacio');
			}

		}		
		
		public function load_teacher_signatures($levelId = ''){

			//cargar las materias correspondientes al grado seleccionado
			if($levelId != ''){

				$optionsSignature = '<option value="ninguno">Seleccione una materia:</option>';
				$optionsGrupo = '<option value="ninguno">Seleccione un grupo:</option>';

				$searchTxt = $this -> data_cleaner($levelId);

				$searchSignature = $this -> search("select * from materia where mat_grado='$levelId'",
					                               'Materias cargadas correctamente',
					                               'No se encontraron materias',
					                               'Error al cargar materias');
				
				if($searchSignature['status'] == 'done'){

					$noRecords = mysqli_num_rows($searchSignature['data']); 

					$options = '';

					while($row = mysqli_fetch_assoc($searchSignature['data'])){
						
						$options = $options."<option value='$row[mat_id]'>$row[mat_nombre]</option>";
										
					}

					$optionsSignature = '<option value="ninguno">Seleccione una materia:</option>'.$options;

				}

				$searchGroup = $this -> search("select * from grupos where gru_grado='$levelId'",
											   'Grupos cargados correctamente',
											   'No se encontraron grupos',
											   'Error al cargar los grupos');

				if($searchGroup['status'] == 'done'){

					$noRecords = mysqli_num_rows($searchGroup['data']); 

					$options = '';

					while($row = mysqli_fetch_assoc($searchGroup['data'])){
						
						$options = $options."<option value='$row[gru_id]'>$row[gru_nombre]</option>";
										
					}

					$optionsGroup = '<option value="ninguno">Seleccione una materia:</option>'.$options;

				}
			
				return  Status::get_status('done', 'Datos obtenidos', array('signatures' => array('status' => $searchSignature['status'],
																							 'notice' => $searchSignature['notice'],
																							 'data' => $optionsSignature), 
																	   		 'groups' => array('status' => $searchGroup['status'],
																	   					'notice' => $searchGroup['notice'],
																	   					'data' => $optionsGroup)
																	   		 )
																		);
				

			}else{

					return Status::get_status('no-data', 'No ha ingresado su busqueda', 'vacio');
			}

		}		

		public function add_teacher_signatures($teacherId = 0, $signatureId = 0, $groupId = 0, $levelId){

			//agregar las materias que impartira el profesor
			if($teacherId != 0 && $signatureId != 0){

				$teacherId = $this -> data_cleaner($teacherId);
				$signatureId = $this -> data_cleaner($signatureId);
				$groupId = $this -> data_cleaner($groupId);
				$levelId = $this -> data_cleaner($levelId);
				$addDate = $this -> dateTime;

				//quitar la columna grado de la tabla 

				//$search = $this -> search("select lm_id from asignacion_materias_profesor where lm_profesor=$teacherId and lm_materia=$signatureId");
				$search = $this -> search("select mprof_id from materias_profesor where  mprof_materia=$signatureId  and mprof_grado=$levelId and mprof_grupo=$groupId");

				if($search['status'] == 'no-data'){
			
						$add = $this -> crud("insert into materias_profesor (mprof_profesor, mprof_materia, mprof_grado, mprof_grupo, mprof_fechaDeRegistro) values ($teacherId, $signatureId, $levelId, $groupId, '$addDate')");

						if($add['status'] == 'done'){

							return  Status::get_status($add['status'], 
													   "Materia agregada con exito", 
													   '');

						}else{

							return Status::get_status($add['status'],
													  'Error al agregar materia',
													  ''); 

						}

				}else{

						$status = 'error';
						
						if($search['status'] == 'done'){

							$status = 'no-data';
						}

						return Status::get_multi_status($status,
														'',
														'Ya se ha registrado la materia',
													    'Error al agregar materia',
													    ''); 


				}

				
			}else{

					return Status::get_status('no-data', 'Faltan valores para agregar la materia', 'vacio');
			}

		}		

		public function del_teacher_signature($teacherId = 0, $signatureId = 0){

			//quitar materia de la lista de materias que imparte el profesor 

			if($teacherId != 0 && $signatureId != 0){

				$teacherId = $this -> data_cleaner($teacherId);
				$signatureId = $this -> data_cleaner($signatureId);
				$addDate = $this -> dateTime;
			
				$del = $this -> crud("delete from materias_profesor where mprof_id=$signatureId");

				if($del['status'] == 'done'){

					return  Status::get_status($del['status'], 
											   "Materia eliminada exitosamente", 
											   '');

				}else{

					return Status::get_status($del['status'],
											  'Error al elliminar materia',
											  ''); 

				}
				
			}else{

					return Status::get_status('no-data', 'Faltan valores para eliminar la materia', 'vacio');
			}

		}		

		public function get_teacher_info($id = ''){

			//cargar la lista de materias que tiene asignadas el profesor
			if($id != ''){

				$searchTxt = $this -> data_cleaner($id);

				$search = $this -> search("select * from profesores where id='$id'");

				if($search['status'] == 'done'){

					$noRecords = mysqli_num_rows($search['data']); 

					$table = '';
					$rows = '';
					
					$teacherName = '';
					
					$tableIni = '<table>
									<tr>
										<th>Fecha de nacimiento</th>
										<th>Direccion</th>
										<th>Telefono</th>
										<th>Email</th>
										</tr>';

					while($row = mysqli_fetch_assoc($search['data'])){

						$teacherName = "<div class='info-teacherName'>Profesor: $row[nombre]</div>";
						
						$rows = $rows."<tr>
											<td>$row[fechaNacimiento]</td>
											<td>$row[direccion]</td>
											<td>$row[telefono]</td>
											<td>$row[email]</td>
									   	</tr>";
										
					}

					$tableEnd = '</table>';

					$table = $teacherName.$tableIni.$rows.$tableEnd;

					return  Status::get_status($search['status'], 
											   "Se encontraron $noRecords coincidencias con su busqueda", 
											   $table);

				}else{

					return Status::get_multi_status($search['status'],
													'',
													'No se encontraron coincidencias con su busqueda',
													'Error al buscar datos',
													'vacio'); 

				}

			}else{

					return Status::get_status('no-data', 'No ha ingresado su busqueda', 'vacio');
			}

		}		

		public function add_data($data = ''){
	
			if(Data::loop_empty_data($data, '1')){

				$user = $this -> data_cleaner($data[0]);
				$name = $this -> data_cleaner($data[1]);
				$password = $this -> crypt_data($this -> data_cleaner($data[2]));
				$email = $this -> data_cleaner($data[3]);
				$address = $this -> data_cleaner($data[4]);
				$tel = $this -> data_cleaner($data[5]);
				$bornDate = $this -> data_cleaner($data[6]);

				$status = $this -> data_cleaner($data[7]);
				$addDate = $this -> dateTime;
				$userType = "prof";
				
				$addTeacher = $this -> crud("insert into ".$this -> dataTable." (usuario, nombre, password, fechaNacimiento, direccion, telefono, email,  estado, tipoUsuario, prof_fechaDeRegistro) values ('$user', '$name', '$password', '$bornDate', '$address', '$tel', '$email', '$status', '$userType', '$addDate')", 
											'Profesor registrado correctamente',
											'Error al registrar profesor en profesores');
			
				if($addTeacher['status'] == 'done'){
		
					return Status::get_status($addTeacher['status'],
											  $addTeacher['notice'],
										      '');


				}else{
					
					return Status::get_status($addTeacher['status'],
											  $addTeacher['notice'],
											  '');

				}

			}else{

				return Status::get_status('no-data',
										  'Hay campos vacios',
									      '');

			}

		}

		private function get_data_updateForm($teacherId = ''){

			if(Data::empty_data($teacherId)){

				$teacherId = $this -> data_cleaner($teacherId);
				
				$loadData = $this -> search("select * from ".$this -> dataTable." where profesores.id='$teacherId'", 
											'Datos cargados correctamente',
											'No hay registros del profesor',
											'Error al cargar los datos del profesor para formulario');
			
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
									      'Falta identificador de profesor',
										  '');

			}			

		}

		public function load_data_updateForm($teacherId = ''){
	
			if(Data::empty_data($teacherId)){

				$loadData = $this -> get_data_updateForm($teacherId);
			
				if($loadData['status'] == 'done'){

					return $loadData;

				}else{

					return Status::get_status($loadData['status'],
					      					  $loadData['notice'],
					      					  '');

				}

			}else{

				return Status::get_status('no-data',
									      'Falta id de profesor',
										  '');

			}

		}

		public function set_data($data = ''){
			
			if(Data::loop_empty_data($data, '1')){

				$user = $this -> data_cleaner($data[0]);
				$name = $this -> data_cleaner($data[1]);
				
				if($data[2] != 'vacio'){
				
						$setPassword = "password='".$this -> crypt_md5($this -> data_cleaner($data[2]))."', ";
				
				}else{
				
						$setPassword="";
				
				}
				
				$email = $this -> data_cleaner($data[3]);
				$address = $this -> data_cleaner($data[4]);
				$tel = $this -> data_cleaner($data[5]);
				$bornDate = $this -> data_cleaner($data[6]);
				
				$status = $this -> data_cleaner($data[7]);
				$id = $this -> data_cleaner($data[8]);
				$updateDate = $this -> dateTime;
				
				$addData = $this -> crud('update '.$this -> dataTable.' set usuario="'.$user.'", nombre="'.$name.'", '.$setPassword.' email="'.$email.'", fechaNacimiento="'.$bornDate.'", direccion="'.$address.'",telefono="'.$tel.'", estado="'.$status.'", prof_fechaDeActualizacion="'.$updateDate.'" where id="'.$id.'"', 
					'Profesor actualizado correctamente',
					'Error al actualizer profesorr');
			
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

		public function get_form_setData($data = null){

			if($data['status'] = 'done'){

				$userId = $data['id'];
				$user = $data['user'];
				$name = $data['name'];
				$dateBorn = $data['dateBorn'];
				$address = $data['address'];
				$tel = $data['telephone'];
				$email = $data['email'];

				return '<div class="control-group">
               
			                <label>Usuario:</label>
			                <input type="text" name="usuario" id="usuario" class="set-data" value="'.$user.'" tabindex="1">
			                <label>Nombre:</label>
			                <input type="text" name="nombre" id="nombre" class="set-data" value="'.$name.'" tabindex="2">
			                <label>Fecha de Nacimiento:</label>
			                <input type="date" name="nacimiento" id="nacimiento" class="set-data" value="'.$dateBorn.'" tabindex="3">
			                

			            </div>

			           	<div class="control-group">
			                
			                <label>Direccion:</label>
			                <input type="text" name="direccion" id="direccion" class="set-data" value="'.$address.'" tabindex="4"> 
			                <label>Telefono:</label>
			                <input type="tel" name="telefono" id="telefono"class="set-data" value="'.$tel.'" tabindex="5">
			                <label>Correo Electronico:</label>
			                <input type="email" name="email" id="email" class="set-data" value="'.$email.'" tabindex="6">
			       
			                <input type="hidden" name="userId" id="userId" class="set-data" value="'.$userId.'">
			                  
			       		</div>';

		      }else{

		      	return $data['notice'];
		      
		      } 		

		}

		public function update_status($status = '', $idTeacher = ''){

			$status = $this -> data_cleaner($status);

			$id = $this -> data_cleaner($idTeacher);

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

			$update = $this -> crud("update ".$this -> dataTable." set estado='".$newStatus."' where id='".$id."'",
				          'Estado actualizado correctamente',
				          'Error al actualizar el estado del profesor');

			if($update['status'] == 'done'){

				return Status::get_status($update['status'], $update['notice'], $newStatus);

			}else{

				return Status::get_status($update['status'], $update['notice'], '');

			}

		}

		public function del_data($id = ''){


			$id = $this -> data_cleaner($id);

			$del = $this -> crud("delete from ".$this -> dataTable." where id='$id'",
				                 'Datos eliminados correctamente',
				                 'Error al eliminar datos');

			$del = $this -> multiquery("delete from ".$this -> dataTable." where id='$id';
										delete from asignacion_materias_profesor where lm_profesor='$id';
										delete from calificaiones where cal_profesor='$id';",
				                 		'Datos eliminados correctamente',
				                 		'Error al eliminar datos');


			if($del['status'] == 'done'){

				return Status::get_status($del['status'], $del['notice'], '');

			}else{

				return  Status::get_status($del['status'], $del['notice'], '');

			}


		}

		public function set_acount($data = ''){
			
			if(Data::loop_empty_data($data, '1')){

				$user = $this -> data_cleaner($data[0]);
				$name = $this -> data_cleaner($data[1]);
				$bornDate = $this -> data_cleaner($data[2]);
				$address = $this -> data_cleaner($data[3]);
				$tel = $this -> data_cleaner($data[4]);
				$email = $this -> data_cleaner($data[5]);
				$id = $this -> data_cleaner($data[6]);
				$updateDate = $this -> dateTime;
				
				$update = $this -> crud("update ".$this -> dataTable." set usuario='$user', nombre='$name', email='$email', fechaNacimiento='$bornDate',  direccion='$address', telefono='$tel', prof_fechaDeActualizacion='$updateDate' where id='$id'", 
					"Datos actualizados correctamente",
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

		public function set_password($data = ''){
			
			if(Data::loop_empty_data($data, '1')){

				$userPassword = $this -> data_cleaner($data[0]);
				$newPassword = $this -> data_cleaner($data[1]);
				$newPasswordConfirm = $this -> data_cleaner($data[2]);
				$id = $this -> data_cleaner($data[3]);
				$updateDate = $this -> dateTime;
				
			
				if($newPassword != $newPasswordConfirm){

					return Status::get_status('no-data', 'Su password no coincide en confirmacion'); 

				}else{

					$search = $this -> search("select password from ".$this -> dataTable."  where id='$id'", 
							"password no encontrado",
							"Password encontrado",
							"Error al buscar password");

					if($search['status'] == 'done'){

						$dataPassword = mysqli_fetch_assoc($search['data']);

						$oldPassword = $dataPassword['password'];

						$userPassword = $this -> crypt_md5($userPassword);

					 	if($userPassword != $oldPassword){

							return Status::get_status('no-data', 'Su contraseña anterior es incorrecta');
						
						}else{

							$newPassword = $this -> crypt_md5($newPassword);

							$update = $this -> crud("update ".$this -> dataTable." set password='$newPassword', prof_fechaDeActualizacion='$updateDate' where id='$id'", 
							"Password actualizado correctamente",
							"Error al actualizar password");
					
							if($update['status'] == 'done'){
								
								return Status::get_status($update['status'],
														  $update['notice'],
						
														  '');
							}else{
					
								return Status::get_status($update['status'],
											  $update['notice'],
											  '');

							}	

						}

					}else{

						return Status::get_status($search['status'], $search['notice']);
				
					}	

				}

			}else{

				return Status::get_status('no-data',
									      'Hay campos vacios',
										  '');

			}


		}

		public function get_groups_table($teacherId = ''){

			if(Data::empty_data($teacherId)){

				$teacherId = $this -> data_cleaner($teacherId);
				
				$loadData = $this -> search("select gr_nombre as levelName, gru_id as groupId, gru_nombre as groupName from materias_profesor left join grupos on gru_id=mprof_grupo left join grados on gr_id=mprof_grado  where materias_profesor.mprof_profesor='$teacherId'  group by gru_nombre", 
											'Datos cargados correctamente',
											'No hay registros del profesor',
											'Error al cargar la lista de grupos del profesor');
			
				if($loadData['status'] == 'done'){

					$rows = array();
					$c = 0;

					while($row = mysqli_fetch_assoc($loadData['data'])){

						$rows[$c] = array('id' => $row['groupId'], 
									      'tr' => "<tr><td><a href='ver_grupo.php?group=$row[groupId]' title='Click para ver grupo'>$row[groupName]</a></td><td>$row[levelName]</td></tr>");
						$c++;

					}
					
					return Status::get_status($loadData['status'],
											  $loadData['notice'],
											  $rows);

				}else{
					
					return Status::get_status($loadData['status'],
											  $loadData['notice'],
											  array('id' => 'empty', 'tr' => 'empty'));

				}

			}else{

				return Status::get_status('no-data',
									      'Falta identificador de profesor',
										  '');

			}

		}

		public function get_students_byGroup($group = '', $teacherId){

			if(Data::empty_data($group)){

				$group = $this -> data_cleaner($group);
			
				$noRecords = 0;

				$search = $this -> search("select alumnos.id as studentId, alumnos.nombre as studentName, alumnos.grupo as studentGroup, gru_grado as levelId from alumnos left join grupos on gru_id=alumnos.grupo where alumnos.grupo='$group'", 
										  "Lista cargada exitosamente",
										  "Aun no tinene alumnos en este salon",
										  'Error al buscar lista');

				if($search['status'] == 'done'){

					$noRecords = mysqli_num_rows($search['data']); 

					$table = '';
					$rows = '';

					$tableIni = '<tr><th>Nombre</th><th>Calificar</th></tr>';

					while($row = mysqli_fetch_assoc($search['data'])){

						$rows = $rows."<tr>
											<td>$row[studentName]</td>
											<td>
												<button value='$row[studentId]||$group||$row[levelId]||$teacherId' class='btn qualification-btn'>
													Ver Materias
												</button>
											</td>
									   	</tr>";
										
					}

					$tableEnd = '';

					$table = $tableIni.$rows.$tableEnd;

					return  Status::get_status($search['status'], 
											   "Se encontraron $noRecords coincidencias con su busqueda", 
											   $table);

				}else{

					return Status::get_multi_status($search['status'],
													'',
													$search['notice'],
													$search['notice'],
													'vacio'); 

				}

			}else{

					return Status::get_status('no-data', 'Falta especificar datos para mostrar lista de alumnos', 'vacio');
			
			}

		}

	}
?>