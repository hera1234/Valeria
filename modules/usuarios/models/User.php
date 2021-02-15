<?php 
	
	class User extends Server{

		use Messages, Status;

		public function __construct(){

			parent::__construct();

			$this -> usersTable = "usuarios";

			$this -> userData = array('id' => 'vacio',
							    'user' => 'vacio',
				                'name' => 'vacio',
				                'dateBorn' => 'vacio',
				                'address' => 'vacio',
				                'telephone' => 'vacio',
				                'email' => 'vacio',
				                'userType' => 'vacio',
				                'status' => 'vacio');

		}

		public function get_user_data($user = '', $password = ''){

			$search = $this -> search("select id, usuario, nombre, fechaNacimiento, direccion, telefono, email, tipoUsuario, estado from usuarios where usuario='$user' and password='$password'",
									   'Datos obtenidos correctamente',
									   'No se encontraron datos de usuario',
									    "Error al cargar los datos del usuario");
		
			if($search['status'] == 'done'){

				$data = mysqli_fetch_assoc($search['data']);

				$this -> userData['id'] = $data['id'];
				$this -> userData['user'] = $data['usuario'];
                $this -> userData['name'] = $data['nombre'];
                $this -> userData['dateBorn'] = $data['fechaNacimiento'];
                $this -> userData['address'] = $data['direccion'];
                $this -> userData['telephone'] = $data['telefono'];
                $this -> userData['email'] = $data['email'];
                $this -> userData['userType'] = $data['tipoUsuario'];
                $this -> userData['status'] = $data['estado'];

			}

		}

		public function search_data($searchTxt = ''){

			if($searchTxt != ''){

				$searchTxt = $this -> data_cleaner($searchTxt);
				$noRecords = 0;

				$search = $this -> search("select * from  ".$this -> usersTable." where nombre like '%$searchTxt%'", 
										  "",
										  "No se encontraron coincidencias con su busqueda",
										  'Error al buscar datos');

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
											<td>$row[fechaNacimiento]</td>
											<td>$row[direccion]</td>
											<td>$row[telefono]</td>
											<td>$row[email]</td>
											<td class='centrar-texto'>
												<button class='status-btn table-btn  $class' id='status-btn$row[id]' value='$row[id]||$status' title='Click para modificar el estado del usuario'>
												</button	
											</td>
											<td class='centrar-texto'>
												<button class='update-btn table-btn fas fa-pencil-alt' value='$row[id]' title='Click para abrir el formulario para editar usuario'>
												</button>	
												<button class='del-btn table-btn fas fa-trash-alt' value='$row[id]' title='Click para borrar usuario'>
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

				$user = $this -> data_cleaner($data[0]);
				$name = $this -> data_cleaner($data[1]);
				$password = $this -> crypt_data($this -> data_cleaner($data[2]));
				$email = $this -> data_cleaner($data[3]);
				$address = $this -> data_cleaner($data[4]);
				$tel = $this -> data_cleaner($data[5]);
				$bornDate = $this -> data_cleaner($data[6]);
				$status = $this -> data_cleaner($data[7]);
				$addDate = $this -> dateTime;
				$userType = "admin";
				
				$addData = $this -> crud("insert into ".$this -> usersTable." (usuario, nombre, password, fechaNacimiento, direccion, telefono, email,  estado, tipoUsuario, us_fechaDeRegistro) values ('$user', '$name', '$password', '$bornDate', '$address', '$tel', '$email', '$status', '$userType', '$addDate')", 
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

				$idUser = $this -> data_cleaner($id);
				
				$loadData = $this -> search("select * from ".$this -> usersTable." where id='$id'", 
					'Datos cargados correctamente',
					'No hay datos del usuario',
					'Error al cargar los datos del usuario para formulario');
			
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
				
				$update = $this -> crud("update ".$this -> usersTable." set usuario='$user', nombre='$name', $setPassword  email='$email', fechaNacimiento='$bornDate',  direccion='$address', telefono='$tel', estado='$status', us_fechaDeActualizacion='$updateDate' where id='$id'", 
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

		public function get_form_setData($userId = ''){

			$data = $this -> load_data_updateForm($userId);

			if($data['status'] = 'done'){

				$data = $data['data'];

				$user = $data['usuario'];
				$name = $data['nombre'];
				$dateBorn = $data['fechaNacimiento'];
				$address = $data['direccion'];
				$tel = $data['telefono'];
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

			$update = $this -> crud("update usuarios set estado='".$newStatus."' where id='".$id."'",
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

			$del = $this -> crud("delete from ".$this -> usersTable." where id='$id'",
				          		"Datos borrados correctamente",
				          		"Error al borrar datos");

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
				
				$update = $this -> crud("update ".$this -> usersTable." set usuario='$user', nombre='$name', email='$email', fechaNacimiento='$bornDate',  direccion='$address', telefono='$tel', us_fechaDeActualizacion='$updateDate' where id='$id'", 
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

					$search = $this -> search("select password from ".$this -> usersTable."  where id='$id'", 
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

							$update = $this -> crud("update ".$this -> usersTable." set password='$newPassword', us_fechaDeActualizacion='$updateDate' where id='$id'", 
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

	}

?>