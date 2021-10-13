<div class="ajax-msgPage" id="ajax-msgPage"><?php echo $msg?></div>

<h1 class="title-page">
	
	Administrar Informacion 

</h1>

<div class="page-menuWrap">

		<div class="page-menuRow">
	    	
	    	<div class="page-menuItem">
	        
	        	

	        	<div class="footer-item">
		        
		           	<a href="materias.php" class="btn action-itemBtn">Administrar Materias</a>
		            
		            <div class="no-recordsItem">
						
						<?php 
							
							echo $signaturesNumber.' materias registradas';
						
						?>
		        	
		        	</div>

		        </div>
	  		
	  		</div>	
	        
	        <div class="page-menuItem">
	
	        

	        	<div class="footer-item">

		            <a href='grados.php' class="btn action-itemBtn">Administrar Grados</a>
		        
		        	<div class="no-recordsItem">
					
						<?php 
					
							echo $levelsNumber.' grados registrados';
						
						?>                	
					
					</div>
				
				</div>
	
	        </div>	
	        <div class="page-menuItem">
	        
	        

	        	<div class="footer-item">
		        
		           	<a href="grupos.php" class="btn action-itemBtn">Administrar Grupos</a>
		            
		            <div class="no-recordsItem">
						
						<?php 
							
							echo $groupsNumber.' grupos registrados';
						
						?>
		        	
		        	</div>

		        </div>
	  		
	  		</div>
	       	    
	    </div>

	    <div class="page-menuRow">
	    	
	    	<div class="page-menuItem">
	        
	        	
	            
	            <div class="footer-item">
		            
		            <a href='informacion de colegio.php' class="btn action-itemBtn">Informacion de colegio</a>

		            <div class="no-recordsItem">
					
						<?php 
							
							echo 'Ultima Actualizacion:'.$setDate;
						
						?>
		        	
		        	</div>

		        </div>
	        
	        </div>
	        <div class="page-menuItem page-menuItemEmpty"></div>
	       	<div class="page-menuItem page-menuItemEmpty"></div>

	    </div>
</div>