<div class="title-page">Listado de alumnos del grupo <?php echo $groupName;?></div>

<div id="ajaxMsgPage" class="ajaxMsgPage"></div>

<div class="table-container border-box" id="cargarResultados">

        <table class="table-records" id='table-records'>

            <?php echo $table;?>

        </table>

</div>

<div id="signatures-modal" class="modal">

        <form action="" method="post" id="signatures-form" class="form">
        
            <div class="header-form" id="tituloForm">Calificar Materias</div>

            <p class="info-form">La calificaion maxima a obtener es 10</p>

            <div class="signatures-container" id="signatures-container">   
            
                <!--cargar materias-->
            
            </div>

            <div class="total-wrap" id="total-wrap"></div>
        
            <div class="btns-container">
        
                <button id="close-QSBtn" class="close-formBtn" tabindex="">Cerrar</button>
                <input type="submit" name="set-btn" id="set-dataBtn" class="action-formBtn" value="Actualizar" tabindex="">
        
            </div>
        
        </form>
</div>

