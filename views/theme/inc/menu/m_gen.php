		
    <div class="logoPrincipal alinear-horizontal">
    	
	<?php echo $schoolName; ?>

    </div>
	
    <div class="botonNavMenu box-sizing" id="botonNavMenu">boton</div>

    <nav class="alinear-Horizontal barraNavegacion" id='barraNavegacionPrincipal'>
       
       	<a href="principal.php"><div class="menu alinear-horizontal">Inicio</div></a>
    			
        <div class="menu-usuario alinear-horizontal" id='menuUsuario'>
        	
        	<div class="usuario" id='nombreUsuario'>
        	
        		Hola <?php echo $userName; ?>
        		
        	</div> 
   
            <ul id="menuOculto" class="border-box">
   
                <a href="actualizar datos.php">
                    <li class="menus">
                        <img src="ico/user.ico" width="20" height="20">Actualizar Informacion
                    </li>
                </a>
                <a href="cambiar password.php">
                    <li class="menus">
                        <img src="ico/edit.ico" width="20" height="20">Cambiar Contraseña
                    </li>
                </a> 
                <li><hr></hr></li>
                <a href="logout.php">
                    <li class="salir">
                        <img src="ico/exit.ico" width="20" height="20">Salir
                    </li>
                </a>
   
            </ul>
   
        </div>
   
    </nav>
        
        