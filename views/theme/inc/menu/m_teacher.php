<div class="header-logo">
    
    <?php echo $schoolName; ?>

</div>

<nav class="nav-page" id='barraNavegacionPrincipal'>
   
    <ul class="nav-menuWrap">
         <li class="nav-menuItem"><a href="principal.php">Inicio</a></li>    
    </ul>

    <div class="nav-userMenuWrap" id='nav-userMenuWrap'>
        
        <div class="nav-userMenu menu-btn" id='user-menuBtn'>
        
            Hola <?php echo $userName; ?>
            
        </div> 

        <ul id="desplegable-menu" class="desplegable-menu">

            <li class="nav-desplegableItem">
                <a href="cuenta.php">
                    Actualizar Informacion
                </a>
            </li>
            <li class="nav-desplegableItem">
                <a href="cambiar_password.php">
                    Cambiar Contraseña
                </a>
            </li>
            <li><hr></hr></li>
            <li class="nav-desplegableItem">
                <a href="logout.php">
                    Salir
                </a>
            </li>

        </ul>

    </div>

</nav>

<!--mobile-->
<div class="mobile-btnContainer hidden">
    <div class="mobile-btnWrap">
        <div class="mobile-btn" id="mobile-btn">
            <span class=" fas fa-bars"></span>
        </div>
    </div>
</div>

<nav class="mobile-menu hidden" id='mobile-menu'>
   
    <ul class="nav-menuWrap nav-menuWrapMobile">
        <li class="nav-menuItem mobile-item"><a href="principal.php">Inicio</a></li>     
    </ul>

    <div class="nav-userMenuWrap" id='nav-userMenuWrap'>
        
        <div class="nav-userMenu mobile-menuBtn" id='menu-mobileUserBtn'>
        
            Hola <?php echo $userName; ?>
            
        </div> 

    </div>
    <ul id="mobile-userDesplegableMenu" class="mobile-desplegableMenu">

            <li class="nav-desplegableItem">
                <a href="cuenta.php">
                    Actualizar Informacion
                </a>
            </li>
            <li class="nav-desplegableItem">
                <a href="cambiar_password.php">
                    Cambiar Contraseña
                </a>
            </li>
            <li><hr></hr></li>
            <li class="nav-desplegableItem">
                <a href="logout.php">
                    Salir
                </a>
            </li>

        </ul>

</nav>
