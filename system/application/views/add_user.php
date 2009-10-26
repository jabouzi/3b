    <div class="error_message" align="center">
    <?php echo validation_errors(); ?>      
    </div>
    <div id="basic" class="myform">
      <?php echo form_open('admin/add_user'); ?>
        <h1>Ajouter un usag&eacute;</h1>
        <p class="top">&nbsp;</p>
        <label>Nom
            <span class="small">Son nom</span>
        </label>
        <input class="input" type="text" id="nom" name="nom" value="<?php echo set_value('nom'); ?>"/>
        
        <label>Pr&eacute;nom
            <span class="small">Son pr&eacute;nom </span>
        </label>
        <input class="input" type="text" id="prenom" name="prenom" value="<?php echo set_value('prenom'); ?>"/>
        <label>Nom d'utilisateur
            <span class="small">min 5 carac </span>
        </label>
        <input class="input" type="text" id="username" name="username" value="<?php echo set_value('username'); ?>"/>
        <label>Email
            <span class="small">Un email valide</span>
        </label>
        <input class="input" type="text" id="email" name="email" value="<?php echo set_value('email'); ?>"/>
        <label>Mot de passe
            <span class="small">min 6 car</span>
        </label>
        <input class="input" type="password" id="password1" name="password1" value="<?php echo set_value('password1'); ?>"/>
         <label>Mot de passe (confirmer) 
            <span class="small">confirmer min 6 car</span>
        </label>
        <input class="input" type="password" id="password2" name="password2" value="<?php echo set_value('password2'); ?>"/>
        <label>Active
            <span class="small">Activer l'usager</span>
        </label>        
        <input class="input2" type="checkbox" value="1" name="active" id="active" <?php echo set_checkbox('active', '1');?>/>
        <label >Permissions
            <span class="small">Les permissions </span>
        </label>
        <div class="permData">
            <?php $menu = array('Gestion des clients','Gestion des usagers','Ajouter un usager','Ajouter des donn&eacute;es');?>
            <?php for($index = 0;$index < count($menu); $index++):?>            
		    <p class="permission"><input  class="check" type="checkbox" value="<?php echo $index;?>" name="permissions[]" id="permissions[]" <?php echo set_checkbox('permissions[]', $index);?>/><?php echo $menu[$index];?></p>
		    <?php endfor;?>            
        </div>		
        <button  type="submit">Ajouter</button>
        <div class="spacer"></div>

      </form>
    </div>     

</body>
</html>
