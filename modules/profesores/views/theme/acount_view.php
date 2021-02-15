<!Doctye html>
<html>
	<head>
		
		<meta charset="utf-8">
	    
	    <link rel="shortcut icon" href="views/theme/ico/school-buss.ico">
		
		<title>Cuenta</title>
	    
	    <link rel="stylesheet" href="views/theme/css/general.css">
	    <link rel="stylesheet" href="modules/usuarios/views/theme/css/acount.css">
	    <link rel="stylesheet" href="views/theme/css/all.min.css">
	    <link rel="stylesheet" href="views/theme/css/responsive.css">

	   	<script src="views/theme/js/main.js"></script>
        <script src="views/theme/js/classes/Ajax.js"></script>
		<script src="modules/profesores/views/theme/js/classes/Teacher.js"></script>
		<script src="modules/profesores/views/theme/js/acount.js"></script>
	    <script src="views/theme/js/classes/Menu.js"></script>
	    <script src="views/theme/js/menu.js"></script>
	
	</head>
	<body>
			
		<div class="main-container">
			
			<header>

		    	<?php
		    
		        	$login -> get_menu()	
			
				?>
		    
		    </header>
		    
		    <section class="content">
		    
		    	<?php
		    
		        	require_once('modules/profesores/views/theme/inc/c_acount.php');
				
				?>

		    </section>

	    </div>

	</body>

</html>
