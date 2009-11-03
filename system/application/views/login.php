<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>3B - Connexion</title>
<link href="<?=base_url();?>public/css/3B.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=base_url();?>public/yui/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="<?=base_url();?>public/yui/build/connection/connection-min.js"></script>
<script type="text/javascript" src="<?=base_url();?>public/js/login.js"></script>

</head>

<body>
<div id="cadre0">
  <div id="cadre1">
    <div id="header">
       <div class="logo"><img src="<?=base_url();?>public/images/logo.gif" width="157" height="157" alt="" /></div>
       <div class="slogan"><img src="<?=base_url();?>public/images/slogan.png" width="428" height="31" alt=""/></div>    
    </div>
    <div class="error_message" align="center">
    <?php echo validation_errors(); ?>      
    <?php if (isset($message)) echo $message;?>
    </div> 
    <div id="conteneur">
       <div class="deb"></div>
       <div class="connexion">
         <?php echo form_open('login'); ?>
           <label>Nom Utilisateur :</label>
           <input type="text" id="username" name="username" value="<?php echo set_value('username'); ?>"/>
           <span>Minimum 5 caractères</span>
           <br /><br />
           <label>Mot De Passe :</label>
           <input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" />
           <span>Minimum 6 caractères</span><br />
           <button id="btn" type="submit">
              <b>Valider</b>
           </button>
         </form>
         <div class="parametre">
           <span><a href="/login/register">Créer un compte</a></span><br />
           <span><a href="/login/forget_password">Mot de passe oublié?</a></span>
         </div>
       </div>
       <div class="fin"></div>
    </div>
    <div id="footer">
      
    </div>
  </div>
</div>
</body>
</html>
