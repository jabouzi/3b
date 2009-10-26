        <?php foreach($data as $item):?>   
        <?php if ($item->active == 1) $checked = "checked=checked"; else $checked = '';?> 
		<p>
            <label class="label7">Nom:</label>
            <input align="left" type="text" value="<?php echo $item->nom;?>" name="nom" id="nom" />
            <label class="label8">Pr&eacute;nom:</label>
            <input align="left" type="text" value="<?php echo $item->prenom;?>" name="prenom" id="prenom" />
            <label class="label2">Email:</label>
            <input type="text" value="<?php echo $item->email;?>" name="email" id="email" />
            <label class="label3">Active:</label>
            <input type="checkbox" <?php echo $checked;?> value="active" name="activeCheckbox" id="activeCheckbox"/>
            <input type="hidden" value="<?php echo $item->type;?>" name="type" id="type"/>
            <input type="hidden" value="<?php echo $item->id;?>" name="id" id="id"/>
            <br />
            <label>Permissions:</label>
            <div class="dataadmin2" >
            <?php $menu = array('Gestion des clients','Gestion des usagers','Ajouter un usager','Ajouter des donn&eacute;es');?>
            <?php foreach($familles as $item):?>
            <?php if(in_array($item,$permissions)) $checked="checked=checked"; else $checked='';?>
		    <p><input type="checkbox" <?php echo $checked;?> value="<?php echo $item;?>" name="f_<?php echo $item;?>" id="f_<?php echo $item;?>" /><?php echo $menu[$item];?></p>
		    <?php endforeach;?>            
            </div>		
        </p>
        <?php endforeach;?>
