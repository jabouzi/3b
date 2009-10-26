
    <div class="error_message" align="center">
    <?php echo validation_errors(); ?>      
    </div>      
    
    <div id="basic" class="myform">
      <?php echo form_open('admin/change_password'); ?>
        <h1>Changer votre mot de passe</h1>
        <p class="top">&nbsp;</p>
        
        <label>Mot de passe
            <span class="small">l'ancien mot de passe</span>
        </label>
        <input class="input" type="password" id="password1" name="password1" value="<?php echo set_value('password1'); ?>"/>
        
        <label>Nouveau mot de passe
            <span class="small">Min 6 cars.</span>
        </label>
        <input class="input" type="password" id="password2" name="password2" value="<?php echo set_value('password2'); ?>"/>
        
        <label>Nouveau mot de passe 
            <span class="small">Min. 6 cars</span>
        </label>
        
        <input class="input" type="password" id="password3" name="password3" value="<?php echo set_value('password3'); ?>"/>
        <button  type="submit">Changer</button>
        <div class="spacer"></div>

      </form>
    </div>     

</body>
</html>
