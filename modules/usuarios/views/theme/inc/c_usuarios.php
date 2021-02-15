<div class="head-page">

    <div class="head-pageGroup head-pageLeft">
    
        <div class="img-headPageWrap">
            <div class="img-headPage">
                <span class="fas fa-users"></span>
            </div>
        </div>
        
        <div class="head-pageTitle">Control de Usuarios</div>

    </div>
    
    <div class="head-pageGroup">

        <div class="head-pageSearchFormWrap">

            <form action="" method="post" name="searchUserForm" id="head-pageSearchForm" class="head-pageSearchForm">
                
                <div class="search-wrap">
                    <input type="search" name="searchTxt" id="head-pageSearchTxt" class="head-pageSearchTxt" placeHolder="Introdusca su Busqueda (Nombre o documento)">
                    <input type="submit" name="searchBtn" id="head-pageSearchBtn"  class="head-pageSearchBtn" value="Buscar">
                </div>
            
                <div class="add-btnWrap">
                    <input type="button" name="new-user" id="head-pageNewRecord" class="head-pageNewRecord" value="Registrar Usuario">
                </div>
            
            </form>

        </div>

    </div>

</div>

<div id="ajaxMsgPage" class="ajaxMsgPage"></div>

<div class="table-container border-box" id="cargarResultados">

        <table class="table-records" id='table-records'>

        	<tr><th class="thIzq ">Usuario</th><th>Nombre</th><th>fecha de Nacimiento</th><th>Direccion</th><th>Telefono</th><th>email</th><th>Tipo de Usuario</th><th>Estado</th><th class="thDer">Editar</th></tr> 
       	
        </table>

</div>

<div id="set-modal" class="modal">

        <form action="" method="post" id="set-form" class="form">
        
            <div class="header-form" id="tituloForm">
                Editar Usuario
            </div>

            <div class="controls-wrap">   
            
                <div class="control-group">
               
                    <label>Usuario:</label>
                    <input type="text" name="usuario" id="usuario" class="set-data" value="" tabindex="1">
                    <label>Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="set-data" value="" tabindex="2">
                    <label>Password:</label>
                    <input type="password" name="password" id="password" class="set-data" value="" tabindex="3">
                    <label>Email:</label>
                    <input type="email" name="email" id="email" class="set-data" value="" tabindex="4">
                    
                </div>
                <div class="control-group">
        
                    <label>Direccion:</label>
                    <input type="text" name="direccion" id="direccion" class="set-data" value="" tabindex="5">
                    <label>Telefono:</label>
                    <input type="tel" name="telefono" id="telefono"class="set-data" value="" tabindex="6">
                    <label>Fecha de nacimiento:</label>
                    <input type="date" name="nacimiento" id="nacimiento" class="set-data" value="" tabindex="7">
                    <label>Estado:</label>
                    <select name="estado" id="estado" class="set-data" tabindex="8">
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">No activo</option>
                    </select>
                    <input type="hidden" name="idProfesor" id="idProfesor" class="set-data" value="">
        
                </div>
        
            </div><!--contenedorInputs-->
        
            <div class="btns-container">
        
                <button id="close-setFormBtn" class="close-formBtn" tabindex="10">Cerrar</button>
                <input type="submit" name="set-btn" id="set-dataBtn" class="action-formBtn" value="Actualizar" tabindex="9">
        
            </div>
        
        </form>
</div>

<div id="add-formModal" class="modal">

        <form action="" method="post" id="add-form" class="form">

            <div class="header-form" id="tituloForm">
                Registro de usuarios
            </div>

            <div class="ajax-msgForm" id='ajaxc-msgForm'></div>

            <div class="controls-wrap">   
            
                <div class="control-group">
                
                    <label>Usuario:</label>
                    <input type="text" name="usuario" id="usuario" class="add-data" value="" tabindex="2">
                    <label>Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="add-data" value="" tabindex="3">
                    <label>Password:</label>
                    <input type="password" name="password" id="password" class="add-data" value="" tabindex="5">
                    <label>Email:</label>
                    <input type="text" name="correo" id="correo" class="add-data" value="" tabindex="7">
                
                </div>
                <div class="control-group">
                
                    <label>Direccion:</label>
                    <input type="text" name="direccion" id="direccion" class="add-data" value="" tabindex="9">
                    <label>Telefono:</label>
                    <input type="tel" name="telefono" id="telefono"class="add-data" value="" tabindex="10">
                    <label>Fecha de Nacimiento:</label><input type="date" name="fecha" id="fecha"class="add-data" value="" tabindex="12">
                    <label>Estado:</label>
                        <select name="estado" id="estado" class="add-data" tabindex="13">
                            <option value="ninguno" selected>Estado</option>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">No activo</option>
                        </select>
                
                </div>
            
            </div>
            
            <div class="btns-container">
        
                <button id="close-formBtn" class="close-formBtn" tabindex="15">Cerrar</button>
                <input type="submit" name="save-btn" id="save-data" class="action-formBtn" value="Registrar" tabindex="14">
        
            </div>
        
        </form>
</div>