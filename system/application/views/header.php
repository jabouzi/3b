<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<title>3B: Services au monde de la publicit&eacute; </title>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>public/css/3B.css" />
<?php if (!empty($stylesheet)):?>
<?php foreach($stylesheet as $css) : ?>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>public/<?=$css?>" />
<?php endforeach;?>
<?php endif;?>
<?php if (!empty($javascript)):?>
<?php foreach($javascript as $js) : ?>
<script type="text/javascript" src="<?=base_url();?>public/<?=$js?>"></script>
<?php endforeach;?>
<?php endif;?>
</head>

<body>

<div id="cadre3">
    <div id="header3">
        <div class="logo"><img src="<?=base_url();?>public/images/logo.gif" alt=""  height="44" border="0" />
        </div>
        <div id="profil">
          <a href="#" class="motdepasse"><?php echo $this->session->userdata['nom'];?></a> 
          <a href="#" class="motdepasse">Modifier Mot de passe</a>  
          <a href="/login/logout" class="outlog">D&eacute;connecter</a>
          <a href="/login/logout"><img src="<?=base_url();?>public/images/btn_fermer.gif" width="17" height="17" alt=""/></a>
        </div>
    </div>
