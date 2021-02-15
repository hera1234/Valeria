<?php 

session_start();

require_once('classes/status.php');
require_once('classes/Messages.php');
require_once('models/Config.php');
require_once('models/Server.php');
require_once('models/Login.php');

$login = new Login();

if($login -> session_verify()){

	$login -> logout_user("location:index.php");

}else{

	header('location:principal.php');

}

?>