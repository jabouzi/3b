<!-- start content -->

<div id="centercontent">

	
	<!--<div class="rubrique"><h4>Rubrique s&eacute;l&eacute;ction</h4></div>-->
	<p><!--<a href="http://www.studio7designs.com"><img src= "images/logo.jpg" alt="#" border="0" style="width: 300px; height: 65px;"/></a><br />--></p>
	
	<div class="centercontentleft"><h4>Annonceur</h4>
		<div id="divannonceur" class="data">
		<?php foreach($annonceur as $item):?>
		<p id="p1<?php echo $item;?>"><input type="checkbox" value="<?php echo $item;?>" name="annonceur_<?php echo $item;?>" id="annonceur_<?php echo $item;?>" /><?php echo $item;?></p>
		<?php endforeach;?>
		</div>
		<button id="selectannonceur"  onclick="add('annonceur')">Ajouter</button>
	</div>	
	<div class="centercontentleft"><h4>Campagne</h4>
		<div id="divcampagne" class="data">
		<?php foreach($campagne as $item):?>
		<p id="p2<?php echo $item;?>"><input type="checkbox" value="<?php echo $item;?>" name="campagne_<?php echo $item;?>" id="campagne_<?php echo $item;?>" /><?php echo $item;?></p>
		<?php endforeach;?>
		</div>
		<button id="selectcampagne" onclick="add('campagne')">Ajouter</button>
	</div>
	<div class="centercontentleft"><h4>Marque</h4>
		<div id="divmarque" class="data">
		<?php foreach($marque as $item):?>
		<p id="p3<?php echo $item;?>"><input type="checkbox" value="<?php echo $item;?>" name="marque_<?php echo $item;?>" id="marque_<?php echo $item;?>" /><?php echo $item;?></p>
		<?php endforeach;?>
		</div>
		<button id="selectmarque" onclick="add('marque')">Ajouter</button>
	</div>
	<div class="centercontentleft"><h4>R&eacute;gie</h4>
		<div id="divregie" class="data">
		<?php foreach($regie as $item):?>
		<p id="p4<?php echo $item;?>"><input type="checkbox" value="<?php echo $item;?>" name="regie_<?php echo $item;?>" id="regie_<?php echo $item;?>"/><?php echo $item;?></p>
		<?php endforeach;?>
		</div>
		<button id="selectregie" onclick="add('regie')">Ajouter</button>
	</div>
	<div class="centercontentleft"><h4>R&eacute;gion</h4>
		<div id="divrue" class="data">
		<?php foreach($rue as $item):?>
		<p id="p5<?php echo $item;?>"><input type="checkbox" value="<?php echo $item;?>" name="rue_<?php echo $item;?>" id="rue_<?php echo $item;?>"/><?php echo $item;?></p>
		<?php endforeach;?>
		</div>
		<button id="selectrue" onclick="add('rue')">Ajouter</button>
	</div>
	<div class="centercontentleft"><h4>Format</h4>
		<div id="divformat" class="data">
		<?php foreach($format as $item):?>
		<p id="p6<?php echo $item;?>"><input type="checkbox" value="<?php echo $item;?>" name="format_<?php echo $item;?>" id="format_<?php echo $item;?>"/><?php echo $item;?></p>
		<?php endforeach;?>
		</div>
		<button id="selectformat" onclick="add('format')">Ajouter</button>
	</div>
	<div class="buttoncontent"><!--<button id="show">Show dialog1</button> --></div>	
	
</div>
</div>


<!-- end content -->
