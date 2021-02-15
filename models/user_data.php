<?php  
	
	$userData = '';

	$userData = $login -> get_userData_byUserType();	

	$userName = $userData['name'];
	$userId = $userData['id'];
	$userType = trim($userData['userType']);

?>
