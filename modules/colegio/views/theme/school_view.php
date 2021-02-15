<!Doctye html>

<html>

	<head>

		<meta charset="utf-8">
	    
	    <link rel="shortcut icon" href="views/theme/ico/school-buss.ico">
		
		<title>Administrar Informacion</title>
	    
	    <link rel="stylesheet" href="views/theme/css/general.css">
	    <link rel="stylesheet" href="modules/colegio/views/theme/css/school.css">
	    <link rel="stylesheet" href="views/theme/css/all.css">
        
	    <script src="views/theme/js/main.js"></script>
        <script src="views/theme/js/classes/Ajax.js"></script>
        <script src="views/theme/js/classes/Menu.js"></script>
	    <script src="views/theme/js/menu.js"></script>

	</head>

	<body>
	
		<div class="main-container">

			<header>
		    	
		    	<?php

		        	$login -> get_menu();

				?>
		    
		    </header>
		    
		    <section class="content">
		    
		    	<?php
		    
		        	require_once('modules/colegio/views/theme/inc/c_school.php');
			
				?>
		    
		    </section>

	    </div>
	
	</body>

</html>