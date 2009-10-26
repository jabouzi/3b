  <div class="error_message" align="center">
    <?php echo validation_errors(); ?> 
  </div> 
  
  <div id="basic" class="myform">
      <?php echo form_open('login/forget_password'); ?>
        <h1>Mot de passe oubli&eacute; ?</h1>
        <p class="top">&nbsp;</p>
        <label>Nom d'usager
            <span class="small">ton nom d'usager</span>
        </label>
        <input class="input" type="username" id="username" name="username" value="<?php echo set_value('username'); ?>"/>
        
        <label>Email
            <span class="small">un email valide</span>
        </label>
        <input class="input" type="text" id="email" name="email" value="<?php echo set_value('email'); ?>"/> 
        <button  type="submit">Ok</button>
        <div class="spacer"></div>

      </form>
    </div>     

</body>
</html>
