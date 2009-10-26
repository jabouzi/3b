<!-- start content -->
<div id="centercontent">


	<!--<div class="rubriqueadmin"><h1>Changer les param&egrave;tres des usagers</h1></div>-->
    
	<p><!--<a href="http://www.studio7designs.com"><img src= "images/logo.jpg" alt="#" border="0" style="width: 300px; height: 65px;"/></a><br />--></p>
	
	<div class="centercontentleftadmin"><h4>Usagers</h4>
		<div id="divclient" class="dataadmin">
        <?php $index = 0;?>
		<?php foreach($users as $item):?>
		<p><input type="radio" value="<?php echo $item->id;?>" name="activeRadio" id="activeRadio" /><?php echo $item->nom . ' ' . $item->prenom;?></p>
		<?php $index++;?>
        <?php endforeach;?>
		</div>
		<button id="selectclient"  onclick="get_data(3)">Selectionner</button>
	</div>
    
    <div class="centercontentleftadmin"><h4>Donn&eacute;es</h4>
		<div id="divdonnees" class="dataadmin">	
        
        </div>
		<button id="applyclient"  onclick="change_data(3)" disabled="true">Appliquer</button> 
	</div>
    
    
</div>
</body>
</html>
