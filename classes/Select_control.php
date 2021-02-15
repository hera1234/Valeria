<?php  
	
	Trait Select_control{
	
		static function get_options($data = '', 
			                        $optionsVal = '',
			                        $optionsTxt = ''){

			if($data != '' && is_array($data)){			 

				if(array_key_exists('status', $data) &&
				   array_key_exists('notice', $data)	 &&
					array_key_exists('data', $data)){

					if($data['status'] == 'done'){

						$options = '';

						while($row = mysqli_fetch_assoc($data['data'])){

							$options = $options.'<option value="'.$row[$optionsVal].'">'.$row[$optionsTxt].'</option>';
											
						}

						return  Status::get_status($data['status'], 
												   $data['notice'], 
												   $options);

					}else{

						return Status::get_multi_status($data['status'],
														'',
														$data['notice'],
														$data['notice'],
														"<option value=''>".$data['notice']."</option>"); 

					}
			
				}else{

					return Status::get_status('info',
											  'Faltan valores para mostrar opciones',
											  '<option value="">Valores en array extraviados</option>'); 

				}

			}else{

				return Status::get_status('info', 
										  'tipo de dato no valido para opciones en select',
										  "<option value=''>Ingrese un array</option>");
			
			}

		}	

	}

?>
