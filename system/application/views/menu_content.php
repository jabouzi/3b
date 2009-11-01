<div id="topmenu">
<div id="small">
<a class="<?php echo $selected['0'];?>" href="/main/index">Affichage</a>  |  
<a class="<?php echo $selected['1'];?>" href="#">Presse</a> | 
<a class="<?php echo $selected['2'];?>" href="#">Internet</a> | 
<a class="<?php echo $selected['3'];?>" href="#">Radio</a> | 
<a class="<?php echo $selected['4'];?>" href="#">TV</a> 
<a class="title" href="#"><?php echo $this->session->userdata['nom'];?> - </a>
<a class="logout" href="/login/change_password">Changer mot de passe</a> | <a class="logout" href="/login/logout">Quitter</a>
</div>
</div>
<div id="messageAdmin" class="messageAdmin" style="display:none"></div>
<div id="content">
