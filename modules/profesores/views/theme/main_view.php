<!DOCTYPE html>
<html>

    <head>
    
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

        <link rel="shortcut icon" href="views/theme/ico/school-buss.ico">

        <title>Profesores</title>

        <link rel="stylesheet" type="text/css" href="views/theme/css/general.css">
        <link rel="stylesheet" href="modules/profesores/views/theme/css/main_page.css">
        <link rel="stylesheet" type="text/css" href="views/theme/css/all.min.css">

        <script src="views/theme/js/classes/Ajax.js"></script>
        <script src="views/theme/js/main.js"></script>
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
            
                    require_once('modules/profesores/views/theme/inc/c_main.php');
            
                ?>
            
            </section>

        </div>
    
    </body>

</html>