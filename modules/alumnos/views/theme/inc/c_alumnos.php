<div class="head-page">

    <div class="head-pageGroup head-pageLeft">
    
        <div class="img-headPageWrap">
            <div class="img-headPage">
                <span class="fas fa-user-graduate"></span>
            </div>
        </div>
    
        <div class="head-pageTitle">Control de alumnos</div>
    
    </div>

    <div class="head-pageGroup">

        <div class="head-pageSearchFormWrap">

            <form action="" method="post" name="searchStudentForm" id="head-pageSearchForm" class="head-pageSearchForm">

                <div class="search-wrap">
                    <input type="search" name="searchTxt" id="head-pageSearchTxt" class="head-pageSearchTxt" placeHolder="Introdusca su Busqueda (Nombre o documento)">
                    <input type="submit" name="searchBtn" id="head-pageSearchBtn"  class="head-pageSearchBtn" value="Buscar">
                </div>
                
                <div class="add-btnWrap">
                    <input type="button" name="new-student" id="head-pageNewRecord" class="head-pageNewRecord" value="Registrar Alumno">
                </div>

            </form>

        </div>

    </div>

</div>

<div id="ajaxMsgPage" class="ajaxMsgPage"></div>

<div class="table-container border-box" id="cargarResultados">

    	<table class="table-records" id='table-records'>

        	<tr><th>Nombre</th><th>Matricula</th><th>Grupo</th><th>Materias</th><th>Estado</th><th class="thDer">Edicion</th></tr>

       	</table>

</div>

<div id="set-modal" class="modal">

    	<form action="" method="post" id="set-form" class="form">

        	<div class="header-form" id="tituloForm">
               Editar Alumno 
            </div>

            <div class="controls-wrap">   
            
                <div class="control-group">
            	
                        <label>Nombre Completo:</label>
                        <input type="text" name="nombre" id="nombre" class="set-data" value="" tabindex="1">
                        <label>Fecha de Nacimiento:</label>
                        <input type="date" name="nacimiento" id="nacimiento" class="set-data" value="" tabindex="2">
                        <label>Matricula:</label>
                        <input type="text" name="matricula" id="matricula" class="set-data" value="" tabindex="3">
                        <label>Nombre del padre:</label>
                        <input type="text" name="nombrePadre" id="nombrePadre" class="set-data" value="" tabindex="4">
                        <label>Nombre de la madre:</label>
                        <input type="text" name="nombreMadre" id="nombreMadre" class="set-data" value="" tabindex="5">
                        
                </div>
                
                <div class="control-group">

                        <label>Direccion:</label>
                        <input type="text" name="direccion" id="direccion" class="set-data" value="" tabindex="6">
                        <label>Telefono:</label>
                        <input type="tel" name="telefono" id="telefono" class="set-data" value="" tabindex="7">
                        
                        <label>Grupo:</label>
                        <select name="grupo" id="grupo" class="set-data" tabindex="8">
                            <option value="" selected>Seleccione un grado:</option>
                            <?php

                                echo $groupOptions;

                            ?>               
                        </select>
                        <label>Estado:</label>
                        <select name="estado" id="estado" class="set-data" tabindex="9">
                            <option value="" selected>Seleccione un estado:</option>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                        <input type="hidden" name="idAlumno" id="idAlumno" class="set-data" value="">
            
                </div>

            </div>

            <div class="btns-container">
            
                <button id="close-setFormBtn" class="close-formBtn" tabindex="11">Cerrar</button>
                <input type="submit" name="set-btn" id="set-dataBtn" class="action-formBtn" value="Actualizar" tabindex="10">
            
            </div>
	
        </form>

</div>


<div id="add-formModal" class="modal">

    	<form action="" method="post" id="add-form" class="form">

        	<div class="header-form" id="tituloForm">
            	Registro de alumnos
            </div>

            <div class="ajax-msgForm" id='ajaxc-msgForm'></div>

            <div class="controls-wrap">   
            
                <div class="control-group">

                    <label>Nombre Completo:</label>
                    <input type="text" name="nombre" id="nombre" class="addData" value="" tabindex="1">
                    <label>Fecha de Nacimiento:</label>
                    <input type="date" name="nacimiento" id="nacimiento" class="addData" value="" tabindex="2">
                    <label>Matricula:</label>
                    <input type="text" name="matricula" id="matricula" class="addData" value="" tabindex="3">
                    <label>Nombre del padre:</label>
                    <input type="text" name="nombrePadre" id="nombrePadre" class="addData" value="" tabindex="4">
                    <label>Nombre de la madre:</label>
                    <input type="text" name="nombreMadre" id="nombreMadre" class="addData" value="" tabindex="5">
                
                </div>
            
                <div class="control-group">
    
                    <label>Direccion:</label>
                    <input type="text" name="direccion" id="direccion" class="addData" value="" tabindex="6">            
                    <label>Telefono:</label>
                    <input type="tel" name="telefono" id="telefono" class="addData" value="" tabindex="7">
                    
                    <label>Grupo:</label>
                    <select name="grupo" id="grupo" class="addData" tabindex="8">
                    	<option value="ninguno" selected="">Seleccione un grupo</option>
                        <?php
                        
                           echo $groupOptions;
                        
                        ?>
                    </select>
                    <label>Estado:</label>
                    <select name="estado" id="estado" class="addData" tabindex="9">
                        <option value="ninguno" selected>Seleccione un estado:</option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
               		</select>
           	
            	</div>
            
            </div>

            <div class="btns-container">
            
                <button id="close-formBtn" class="close-formBtn" tabindex="11">Cerrar</button>
                <input type="submit" name="save-btn" id="save-data" class="action-formBtn" value="Registrar" tabindex="10">
            
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