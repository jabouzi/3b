<?php $keys = array_keys($this->session->userdata['data']);?>
<?php echo form_open('main/afficher_graphes',array('name' => 'gform','id' =>  'gform'));?> 
<select name="x">
  <?php for($key = 0; $key < count($keys); $key++):?>
    <?php if (in_array($keys[$key],array('annonceur','campagne','marque','regie','rue','format'))) :?>
    <option value="<?php echo $keys[$key];?>" <?php if ($selected['x'] == $keys[$key]) echo 'selected="true"'; ?>><?php echo $keys[$key];?></option>
    <?php endif;?>
  <?php endfor;?>
</select>
<select name="y">
  <option value="nbre" <?php if ($selected['y'] == 'nbre') echo 'selected="true"'; ?>>Nombre de faces</option>
  <option value="grp" <?php if ($selected['y'] == 'grp') echo 'selected="true"'; ?>>GRP</option>
</select>
<input type="submit" value="Afficher"/>
<div>
	<img alt="Vertical bars chart" src="<?=base_url();?>public/generated/<?php echo $images[0];?>" style="border: 1px solid gray;"/>
    <br/>
	<img alt="Vertical bars chart" src="<?=base_url();?>public/generated/<?php echo $images[1];?>" style="border: 1px solid gray;"/>
</div>
</div>


