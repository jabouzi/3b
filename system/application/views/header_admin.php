<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>

<head>

<title>3B</title>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>public/css/stylesheet.css" media="screen, projection, tv " />
<?php if (!empty($stylesheet)):?>
<?php foreach($stylesheet as $css) : ?>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>public/<?=$css?>" media="screen, projection, tv " />
<?php endforeach;?>
<?php endif;?>
<?php if (!empty($javascript)):?>
<?php foreach($javascript as $js) : ?>
<script type="text/javascript" src="<?=base_url();?>public/<?=$js?>"></script>
<?php endforeach;?>
<?php endif;?>
</head>

<body>

<!-- start top menu and blog title-->

<div id="blogtitle">
		<div id="small"><a class="selected" href="#"><img src="<?=base_url();?>public/css/images/logo3b_small.png" /></a> Administration </div>		
</div>	
