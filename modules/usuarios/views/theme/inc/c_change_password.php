<h1 class="title-page">Cambio de contraseña</h1>

<div id="set-formWrap" class="set-formWrap">
		
        <form action="" method="post" id="set-form" class="set-form">
            
            <h2 class="header-form">Cambiar Contraseña</h2>
            
            <div class="ajax-msgPage" id="ajax-msgPage"></div>

            <div class="controls-wrap">
            
                <div class="control-group">
            
                    <label>Contraseña Antigua</label>
                    <input type="password" name="antiguaContraseña" id="antiguaContraseña" class="set-data" value="" tabindex="1">
                    <label>Nueva Contraseña</label>
                    <input type="password" name="nuevaContraseña" id="nuevaContraseña" class="set-data" value="" tabindex="2">
                    <label>Confirmar Contraseña</label>
                    <input type="password" name="confirmarContraseña" id="confirmarContraseña" class="set-data" value="" tabindex="3">

                    <input type="hidden" name="userId" id="userId" class="set-data" value="<?php echo $userId;?>">
            
                </div>
            
            </div>
        
            <div class="btns-container">
        
                <input type="submit" name="set-btn" id="set-dataBtn" class="action-formBtn" value="Editar" tabindex="11">
        
            </div>
    	
        </form>

</div>