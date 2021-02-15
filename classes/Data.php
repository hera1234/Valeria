<?php 

	trait Data{
		
		function __construct(){
			
		}

		public static function empty_data($data = ""){

			if($data != "" && $data != null && 
			   $data != "undefined" || $data != 0){

				return true;

			}else{

				return false;
			
			}

		}

		public static function loop_empty_data($arrayData = '', $arrayType = ''){

			if($arrayData != '' && $arrayType != ''){

				$status = true;

				switch ($arrayType) {
					case '1':

						for($i=0; $i < count($arrayData); $i++){

							if(!Data::empty_data($arrayData[$i])){

								$status = false;	
								break;
							}

						}

						return $status;
					
					break;
					case '2':
						
						foreach ($arrayData as $value) {
							
							if(!Data::empty_data($value)){

								$status = false;	
								break;

							}															

						}

						return $status;

					break;
					default:

						return false;
					
					break;
				
				}

			}else{

				return false;

			}
		}

	}

?>