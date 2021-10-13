<div class="head-page">

    <div class="head-pageGroup head-pageLeft">

      
    
        <div class="head-pageTitle">Control de Grados</div>
    
    </div>

    <div class="head-pageGroup">

        <div class="head-pageSearchFormWrap">

            <form action="" method="post" name="searchSignatureForm" id="head-pageSearchForm" class="head-pageSearchForm">
                
                <div class="search-wrap">
                    <input type="search" name="searchTxt" id="head-pageSearchTxt" class="head-pageSearchTxt" placeHolder="Introdusca el nombre del grado">
                    <input type="submit" name="searchBtn" id="head-pageSearchBtn"  class="head-pageSearchBtn" value="Buscar">
                </div>
                
                <div class="add-btnWrap">
                    <input type="button" name="new-user" id="head-pageNewRecord" class="head-pageNewRecord" value="Registrar Grado">
                </div>

            </form>

        </div>

    </div>

</div>

<div id="ajaxMsgPage" class="ajaxMsgPage"></div>


<div class="table-container border-box" id="cargarResultados">

        <table class="table-records" id='table-records'>

            <tr><th class="thIzq">Nombre</th><th>Estado</th><th class="thDer">Edicion</th></tr>
        
        </table>

</div>


<div id="set-modal" class="modal">

        <form action="" method="post" id="set-form" class="form">
        
            <div class="header-form" id="tituloForm">
                Editar grado
            </div>

            <div class="controls-wrap">   
            
                <div class="control-group">

                    <label>Grado:</label>
                    <input type="text" name="materia" id="materia" class="set-data" value="" tabindex="1">
                    
                </div>
                <div class="control-group">
    
                    <label>Estado:</label>
                    <select name="estado" id="estado" class="set-data" tabindex="8">
                        <option value="ninguno">Seleccionar estado</option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
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
                Registro de grados
            </div>

            <div class="ajax-msgForm" id='ajaxc-msgForm'></div>

            <div class="controls-wrap">   
            
                <div class="control-group">
                
                    <label>Grado:</label>
                    <input type="text" name="nombre" id="nombre" class="add-data" value="" tabindex="1">
                
                </div>
                <div class="control-group">
            
                    <label>Estado:</label>
                        <select name="estado" id="estado" class="add-data" tabindex="2">
                            <option value="ninguno" selected>Seleccionar estado</option>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                
                </div>
            
            </div>
            
            <div class="btns-container">
        
                <button id="close-formBtn" class="close-formBtn" tabindex="4">Cerrar</button>
                <input type="submit" name="save-btn" id="save-data" class="action-formBtn" value="Registrar" tabindex="3">
        
            </div>
        
        </form>
</div>