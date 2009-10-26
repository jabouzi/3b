  <div class="error_message" align="center">
    <?php echo validation_errors(); ?>      
    <?php if (isset($message)) echo $message;?>
  </div> 
  
  <div id="basic" class="myformlogin">
      <?php echo form_open('login'); ?>
        <h1>Connexion</h1>
        <p class="top">&nbsp;</p>
        <label>Nom d'usager
            <span class="small">min 5 car</span>
        </label>
        <input class="input" type="username" id="username" name="username" value="<?php echo set_value('username'); ?>"/>
        
        <label>Mot de passe
            <span class="small">Min 6 cars.</span>
        </label>
        <input class="input" type="password" id="password" name="password" value="<?php echo set_value('password'); ?>"/> 
        <button  type="submit"> &nbsp;Ok&nbsp; </button>
        <br />  
        <a href="/3B/index.php/login/register">Cr&eacute;er un compte</a>  
        <br />    
        <a href="/3B/index.php/login/forget_password">Mot de passe oubli&eacute; ?</a>
        <div class="spacer"></div>

      </form>
    </div>  
    <div class="logo"><img src="<?=base_url();?>public/css/images/logo3b_big.png" /></div>  

</body>
</html>
