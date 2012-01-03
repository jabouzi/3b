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
           <div class="logo"><img src="<?=base_url();?>public/images/logo.gif" alt="" height="44" border="0" /></div>
     </div>
     <div id="bloc1">
         <?php echo form_open('login'); ?>
               <label>Nom Utilisateur</label>
               <input type="text" id="username" name="username" value="<?php echo set_value('username'); ?>"/>
               <span>Minimum 5 caract&egrave;res</span>
               <br /><br />
               <label>Mot De Passe</label>
               <input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" />
               <span>Minimum 6 caract&egrave;res</span><br />
               <button id="btn" class="valider" type="submit"><b>Valider</b></button>
         </form>
     </div>
     <div id="bloc2">
       <H1>Pr&eacute;sentation soci&eacute;t&eacute;:</H1> 
<p class="presentation">texte texte texte texte texte texte texte texte texte texte texte texte texte texte texte texte
texte texte texte texte texte texte texte texte texte texte texte texte texte texte texte texte
texte texte texte texte texte</p>
     </div>
     <div id="bloc3">
       <H2>Pr&eacute;sentation produits:</H2> 
<p>texte texte texte texte texte texte texte texte texte texte texte texte texte texte texte texte
texte texte texte texte texte texte texte texte texte texte texte texte texte texte texte texte
texte texte texte texte texte</p>
     </div>
    <p class="copyright" align="center">Developp&eacute; par GFplus canada<br>
&copy; copyright 2009 3BMetrie
</p>
   </div>
</div>
</body>
<script type="text/javascript">

  var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-1859187-15']);
    _gaq.push(['_trackPageview']);

        (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    	})();

</script>
</html>



