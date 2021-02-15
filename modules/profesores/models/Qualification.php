<?php

	class Qualification extends Server{

		public $headTableSCR;
		private $dataTable;

		public function __construct(){

			parent::__construct();

			$this -> qualificationsTable = 'calificaciones';

			$this -> headTableSCR = '<tr><th class="thIzq">Nombre</th><th class="thDer">Calificar</th></tr>';

		}

		public function get_qualifications_form($teacherId = '', 
												$levelId = '',
												$groupId = '',
												$studentId = ''){

			if(Data::empty_data($teacherId) &&
			   Data::empty_data($levelId)&&  
			   Data::empty_data($groupId) && 
			   Data::empty_data($studentId)){

				$searchTxt = $this -> data_cleaner($teacherId);
				$levelId = $this -> data_cleaner($levelId);
				$groupId = $this -> data_cleaner($groupId);
				$studentId = $this -> data_cleaner($studentId);

				$noRecords = 0;

				$search = $this -> search("select mat_nombre as signatureName, mat_id as signatureId from materias_profesor left join materia on mat_id=mprof_materia  left join alumnos on alumnos.grupo=mprof_grupo where alumnos.id=$studentId and mprof_grupo=$groupId and mprof_grado=$levelId and mprof_profesor=$teacherId", 
										  "",
										  "No se encontraron actividades registradas para este salon",
										  'Error al buscar datos');

				$searchQ = $this -> search("select * from calificaciones where cal_profesor=$teacherId and cal_grado=$levelId and cal_grupo=$groupId and cal_alumno=$studentId", 
										  "",
										  "",
										  'Error al buscar calificaiones');

				$arrayCali = array();

				if($searchQ['status'] == 'done'){

					$c = 0;

					while($row = mysqli_fetch_assoc($searchQ['data'])){

						$arrayCali[$c] = array('id' => $row['cal_materia'], 'calificacion' => $row['cal_calificacion']); 

						$c++;

					}
					
				}

				if($search['status'] == 'done'){

					$table = '';
					$controls = array();
					$c = 0;
					$tabindex = 1;
					$calificacion = 0;

					while($row = mysqli_fetch_assoc($search['data'])){

						for($i = 0; $i < count($arrayCali); $i++){
							
							if($row['signatureId'] == $arrayCali[$i]['id']){

								$calificacion = $arrayCali[$i]['calificacion'];

							}

							
						}

						$controls[$c] = "<div class='control-wrap'>	
											<label>$row[signatureName]</label>
											<input type='text' name='$row[signatureName]' class='set-data' id='$row[signatureId]' value='$calificacion' tabindex='$tabindex'>
										</div>";
						
						$c++;
						$tabindex++;

					}

					return  Status::get_status($search['status'], 
											   "Se encontraron $noRecords coincidencias con su busqueda", 
											   $controls);

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

		public function set_qualifications($data = ''){
		
			$arrayData = array();	
			$status = true;

			if(Data::loop_empty_data($data, '1')){

					for($i=0; $i < count($data); $i++){

						if($data[$i] -> points > 10 || $data[$i] -> points < 0){
							
							$status = false;

							break;

						}else{	
						
							$data[$i] -> teacher = $this -> data_cleaner($data[$i] -> teacher);
							$data[$i] -> level = $this -> data_cleaner($data[$i] -> level);
							$data[$i] -> group = $this -> data_cleaner($data[$i] -> group);
							$data[$i] -> student = $this -> data_cleaner($data[$i] -> student);
							$data[$i] -> signature  = $this -> data_cleaner($data[$i] -> signature);
							$data[$i] -> points = $this -> data_cleaner($data[$i] -> points);

						}	
					
					}	

					if(!$status){

						return Status::get_status('no-data',
					             				  'Las calificaciones no deben ser mayores a 10 ni menores de 0',
					                              '');						

					}else{
						
						$todayDate = $this -> dateTime;
						$sqlStatus = '';
						$sqlNotice = '';

						$arrayTest=array();

						for($i = 0; $i < count($data); $i++){
							
							$sql = $this -> search("select cal_id from calificaciones  where 
									                 cal_profesor='".$data[$i] -> teacher."' and  
													 cal_grado='".$data[$i] -> level."' and 
													 cal_grupo='".$data[$i] -> group."' and 
													 cal_alumno='".$data[$i] -> student."' and 
													 cal_materia='".$data[$i] -> signature."'", 
												   '',
												   'No se encontraron materias registradas para este salon',
												   'Error al buscar datos');
						
							if($sql['status'] == 'done'){

								$calificacion = mysqli_fetch_assoc($sql['data']);

								$sql = $this -> crud("update ".$this -> qualificationsTable." 
													 set cal_calificacion='".$data[$i] -> points."',
													 cal_fechaDeActualizacion='$todayDate'
													 where cal_id=$calificacion[cal_id]", 
													'Calificaciones actualizadas correctamente',
													'Error al actualizar datos');

							}else{

								if($sql['status'] == 'no-data'){

									$sql = $this -> crud("insert into ".$this -> qualificationsTable." 
														(cal_profesor, cal_grado, cal_grupo, 
														cal_alumno, cal_materia, cal_calificacion, 
														cal_fechaDeRegistro) values (
														'".$data[$i] -> teacher."', 
														'".$data[$i] -> level."',
														'".$data[$i] -> group."',
														'".$data[$i] -> student."',
														'".$data[$i] -> signature."',
														'".$data[$i] -> points."', 
														'$todayDate')", 
													    'Calificaciones registradas correctamente',
													    'Error al registrar datos');
								
						

								}

							}

						}

						if($sql['status'] == 'done'){
						
							return Status::get_status($sql['status']	,
													  $sql['notice'],
													  '');

						}else{
							
							return Status::get_status($sql['status'],
													  $sql['notice'],
													  '');

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