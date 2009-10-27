<?php if ('1' == $this->session->userdata['type']) $permissions = array(0,1,2,3);?>
<div id="topmenu">
<div id="small">
<?php if(in_array('0',$permissions)):?>
<a class="<?php echo $selected['0'];?>" href="/index.php/admin/manage_clients">Gestion des clients</a> | 
<?endif?>
<?php if(in_array('1',$permissions)):?>
<a class="<?php echo $selected['1'];?>" href="/index.php/admin/manage_users">Gestion des usagers</a> | 
<?endif?>
<?php if(in_array('2',$permissions)):?>
<a class="<?php echo $selected['2'];?>" href="/index.php/admin/add_user">Ajouter un usager</a> | 
<?endif?>
<?php if(in_array('3',$permissions)):?>
<a class="<?php echo $selected['3'];?>" href="/index.php/admin/upload_file">Ajouter des donn&eacute;es</a> | 
<?endif?>
<a class="<?php echo $selected['4'];?>" href="/index.php/admin/change_password">Changer mot passe</a>
 <a class="logout2" href="/index.php/login/logout">Quitter</a>
</div>
</div>
<div id="messageAdmin" class="messageAdmin" style="display:none"></div>
<div id="content">
