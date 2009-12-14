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
<div id="cadre3">
   <div id="col_gauche">
     <img src="<?=base_url();?>public/images/panneau-coordonnegif.gif" width="243" height="557" />   
   </div>
   <div id="col_droite">
     <div id="header3">
           <div class="logo"><img src="<?=base_url();?>public/images/logo2.gif" alt="" width="193" height="65" border="0" /></div>
     </div>
     <div id="bloc1">
         <?php echo form_open('login'); ?>
               <label>Nom Utilisateur</label>
               <input type="text" id="username" name="username" value="<?php echo set_value('username'); ?>"/>
               <span>Minimum 5 caractères</span>
               <br /><br />
               <label>Mot De Passe</label>
               <input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" />
               <span>Minimum 6 caractères</span><br />
               <button id="btn" class="valider" type="submit"><b>Valider</b></button>
         </form>
     </div>
     <div id="bloc2">
       <H1>Présentation société:</H1> 
<p class="presentation">texte texte texte texte texte texte texte texte texte texte texte texte texte texte texte texte
texte texte texte texte texte texte texte texte texte texte texte texte texte texte texte texte
texte texte texte texte texte</p>
     </div>
     <div id="bloc3">
       <H2>Présentation produits:</H2> 
<p>texte texte texte texte texte texte texte texte texte texte texte texte texte texte texte texte
texte texte texte texte texte texte texte texte texte texte texte texte texte texte texte texte
texte texte texte texte texte</p>
     </div>
    
   </div>
</div>
</body>
</html>



