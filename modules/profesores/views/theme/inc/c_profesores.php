<div class="head-page">

    <div class="head-pageGroup head-pageLeft">
    	
        <div class="img-headPageWrap">
            <div class="img-headPage">
                <span class="fas fa-chalkboard-teacher"></span>
            </div>
        </div>
        
        <div class="head-pageTitle">Control de Profesores</div>

    </div>
    
    <div class="head-pageGroup">
        
        <div class="head-pageSearchFormWrap">

        	<form action="" method="post" name="searchTeacherForm" id="head-pageSearchForm" class="head-pageSearchForm">

                <div class="search-wrap">    
                	<input type="search" name="searchTxt" id="head-pageSearchTxt" class="head-pageSearchTxt" placeHolder="Introdusca su Busqueda (Nombre o documento)">
                    <input type="submit" name="searchBtn" id="head-pageSearchBtn"  class="head-pageSearchBtn" value="Buscar">
                </div>
                <div class="add-btnWrap">
                    <input type="button" name="new-teacher" id="head-pageNewRecord" class="head-pageNewRecord" value="Registrar Profesor">
                </div>
            </form>

        </div>

    </div>

</div>

<div id="ajaxMsgPage" class="ajaxMsgPage"></div>

<div class="table-container border-box" id="cargarResultados">

        <table class="table-records" id='table-records'>

            <tr><th class="thIzq">Usuario</th><th>Nombre</th><th>Materias</th><th>Info</th><th>Estado</th><th class="thDer">Edicion</th></tr>

        </table>

</div>

<div id="set-modal" class="modal">

        <form action="" method="post" id="set-form" class="form">
        
            <div class="header-form" id="tituloForm">
                Editar profesor
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
        
         	</div>
        
            <div class="btns-container">
        
                <button id="close-setFormBtn" class="close-formBtn" tabindex="10">Cerrar</button>
                <input type="submit" name="set-btn" id="set-dataBtn" class="action-formBtn" value="Actualizar" tabindex="9">
        
            </div>
    	
        </form>
</div>

<div id="add-formModal" class="modal">

        <form action="" method="post" id="add-form" class="form">

            <div class="header-form" id="tituloForm">
                Registro de profesor
            </div>

            <div class="ajax-msgForm" id='ajaxc-msgForm'></div>

            <div class="controls-wrap">   
            
                <div class="control-group">
                
                    <label>Usuario:</label>
                    <input type="text" name="usuario" id="usuario" class="add-data" value="" tabindex="1">
					<label>Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="add-data" value="" tabindex="2">
                    <label>Password:</label>
                    <input type="password" name="password" id="password" class="add-data" value="" tabindex="3">
                    <label>Email:</label>
                    <input type="text" name="correo" id="correo" class="add-data" value="" tabindex="4">
                    
                </div>
                <div class="control-group">
                    
                    <label>Direccion:</label>
                    <input type="text" name="direccion" id="direccion" class="add-data" value="" tabindex="5">
                    <label>Telefono:</label>
                    <input type="tel" name="telefono" id="telefono" class="add-data" value="" tabindex="6">
        			<label>Fecha de Nacimiento:</label>
                    <input type="date" name="fecha" id="fecha" class="add-data" value="" tabindex="7">
                    <label>Estado:</label>
                    <select name="estado" id="estado" class="add-data" tabindex="8">
                        <option value="ninguno" selected>Estado</option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">No activo</option>
                    </select>
           		
                </div>
    		
            </div>
            
            <div class="btns-container">
        
                <button id="close-formBtn" class="close-formBtn" tabindex="10">Cerrar</button>
                <input type="submit" name="save-btn" id="save-data" class="action-formBtn" value="Registrar" tabindex="9">
        
            </div>
    	
        </form>
</div>

<div class="modal" id="signatures-listModal">

    <div class="signatures-listWrap">
        
        <div class="header-form" id="tituloForm">
            Lista de materias
        </div>

        <div class="ajax-msgForm" id='ajaxc-msgForm'></div>
 
        <div id="signatures-list" class="signatures-list">

            <div class="no-dataTableMsg">Sin materias asignadas</div>

        </div>
        <div class="btns-container">
        
            <button class="close-formBtn" id="close-signaturesList">Cerrar</button>

        </div>
       
    </div>

</div>

<div id="add-signaturesModal" class="modal">

        <form action="" method="post" id="add-signatureForm" class="form">

            <div class="header-form" id="tituloForm">
                Agregar Materia
            </div>

            <div class="ajax-msgForm" id='ajaxc-msgForm'></div>

            <div class="controls-wrap">   
            
                <div class="control-group">
                
                    <label>Grado:</label>
                    <select name="grado" id="grado-materia" class="add-signature" tabindex="1">
                        <option value="ninguno" selected>Seleccione un grado:</option>
                        <?php

                            echo $optionsL;

                        ?>               
                    </select>                   
                      
                </div>
                <div class="control-group">
                    
                    <label>Materia:</label>
                    <select name="materia" id="materia-profesor" class="add-signature" tabindex="2">
                        <option value="ninguno" selected>Seleccione una materia:</option>            
                    </select>
            
                </div>
                <div class="control-group">
                    
                    <label>Grupo:</label>
                    <select name="materia" id="grupo-profesor" class="add-signature" tabindex="2">
                        <option value="ninguno" selected>Seleccione un grupo:</option>            
                    </select>
            
                </div>
            
            </div>
            
            <div class="btns-container">
        
                <button id="close-addSignaturesBtn" class="close-formBtn" tabindex="4">Cerrar</button>
                <input type="submit" name="save-btn" id="add-signatureBtn" class="action-formBtn" value="Registrar" tabindex="3">
        
            </div>
        
        </form>
</div>

<div class="modal" id="info-modal">

    <div class="info-container">
        
        <div class="header-form" id="tituloForm">
            Informacion de profesor
        </div>

        <div class="ajax-msgForm" id='ajaxc-msgForm'></div>
 
        <div id="info-wrap" class="info-wrap">

            <p>Sin informacion</p>

        </div>
        <div class="btns-container">
        
            <button class="close-formBtn" id="close-infoModal">Cerrar</button>

        </div>
       
    </div>

</div>