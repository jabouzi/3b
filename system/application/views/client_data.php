        <?php foreach($data as $item):?>   
        <?php if ($item->active == 1) $checked = "checked=checked"; else $checked = '';?> 
		<p>
            <label class="label1">Nom de la compagnie:</label>
            <input align="left" type="text" value="<?php echo $item->nom;?>" name="nom" id="nom" />
            <label class="label2">Email:</label>
            <input type="text" value="<?php echo $item->email;?>" name="email" id="email" />            
            <label class="label4">Contact:</label>
            <input type="text" value="<?php echo $item->contact;?>" name="contact" id="contact" />
            <label class="label5">T&eacute;l&eacute;phone:</label>
            <input type="text" value="<?php echo $item->telephone;?>" name="tel" id="tel" />            
            <label class="label6">Adresse:</label>
            <input type="text" value="<?php echo $item->address;?>" name="address" id="address" />   
            <label class="label3">Active:</label>
            <input type="checkbox" <?php echo $checked;?> value="active" name="activeCheckbox" id="activeCheckbox"/>
            <input type="hidden" value="<?php echo $item->type;?>" name="type" id="type"/>
            <input type="hidden" value="<?php echo $item->id;?>" name="id" id="id"/>
            <br />
            <label>Permissions:</label>
            <div class="dataadmin2" >
            <?php foreach($familles as $item):?>
            <?php if(in_array($item->famille,$permissions)) $checked="checked=checked"; else $checked='';?>
		    <p><input type="checkbox" <?php echo $checked;?> value="<?php echo $item->famille;?>" name="f_<?php echo $item->famille;?>" id="f_<?php echo $item->famille;?>" /><?php echo $item->famille;?></p>
		    <?php endforeach;?>            
            </div>		
        </p>
        <?php endforeach;?>
