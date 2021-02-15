<?php 
	
	trait Status{

		public static function get_status($status = "", $notice = "", $data = ""){

			if (!isset($status)) {
				$status = "";
			}
			
			if (!isset($notice)) {
				$notice = "";
			}

			if (!isset($data)) {
				$data = "";	
			}

			return array("status" => $status, "notice" => $notice, "data" => $data);

		}

		public static function get_multi_status($status = "", 
									          $successNotice = "", 
								 	          $infoNotice = "", 
									          $errorNotice = "", 
								 	          $data = ""){

			switch($status){

				case"done":
				
					$notice = $successNotice;

				break;
				case"no-data":
				
					$notice = $infoNotice;

				break;
				case"error":
				
					$notice = $errorNotice;

				break;

				default:
				
					$notice = "No se reconoce el status".$status;

				break;

			}

			return array("status" => $status, "notice" => $notice, "data" => $data);

		}


	}

?>