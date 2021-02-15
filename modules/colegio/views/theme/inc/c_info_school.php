    <h1 class="title-page">
        Informacion del colegio
    </h1>  

    <div class="update-infoBtnWrap">
        
        <button class="btn update-infoBtn" id="set-infoBtn" value="<?php echo $idSchool;?>">
            Actualizar informacion
        </button>
    
    </div>

    <div id="ajax-msgPage" class="ajax-msgPage"></div>
    
    <div class="school-infoWrap">
       
        <ul class='info-listWrap'>
            <li><strong>Nombre de la escuela: </strong><?php echo $schoolName;?></li>
            <li><strong>Pais: </strong><?php echo $country;?></li>
            <li><strong>Ciudad: </strong><?php echo $city;?></li>
            <li><strong>Direccion: </strong><?php echo $address;?></li>
         </ul>
    
         <ul class="info-listWrap">
            <li><strong>Email: </strong><?php echo $email;?></li>
            <li><strong>Telefono: </strong><?php echo $tel;?></li>
            <li><strong>Sitio web: </strong><?php echo $webSite;?></li>
            <li><strong>Ultima Actulizacion: </strong><span class="school-data"><?php echo $setDate;?></span></li>
        </ul>
    
    </div>

    <div id="set-modal" class="modal">

        <form action="" method="post" id="set-form" class="form">

            <div class="header-form" id="tituloForm">
                Actualizar informacion del colegio
            </div>

            <div class="controls-wrap">   
            
                <div class="control-group">
                
                        <label>Nombre de la escuela:</label>
                        <input type="text" name="nombre" id="nombre" class="set-data" value="<?php echo $schoolName;?>" tabindex="1">
                        <label>Pais:</label>
                        <input type="text" name="matricula" id="matricula" class="set-data" value="<?php echo $country;?>" tabindex="2">
                        <label>Ciudad:</label>
                        <input type="text" name="ciudad" id="ciudad" class="set-data" value="<?php echo $city;?>" tabindex="3">
                        <label>Direccion:</label>
                        <input type="text" name="direccion" id="direccion" class="set-data" value="<?php echo $address;?>" tabindex="4">

                </div>
                
                <div class="control-group">

                        <label>Email:</label>
                        <input type="text" name="email" id="email" class="set-data" value="<?php echo $email;?>" tabindex="5">
                        <label>Telefonos:</label>
                        <input type="tel" name="telefono" id="telefono" class="set-data" value="<?php echo $tel;?>" tabindex="6">
                        <label>Sitio Web:</label>
                        <input type="text" name="web" id="web" class="set-data" value="<?php echo $webSite;?>" tabindex="7">                    
                </div>

            </div>

            <div class="btns-container">
            
                <button id="close-setFormBtn" class="close-formBtn" tabindex="9">Cerrar</button>
                <input type="submit" name="set-btn" id="set-dataBtn" class="action-formBtn" value="Actualizar" tabindex="8">
            
            </div>
    
        </form>

</div>


   
