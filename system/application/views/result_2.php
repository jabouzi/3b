<?php
/*Skander Jabouzi 2009 result.php : afficher le tableau croisé et le cacher dans fichier*/

ob_start();
$cachefile  = "./system/application/views/result_cached.php";  
$fp = fopen($cachefile, 'w');              
?>
<?php  foreach($panneaux as $panneau):?>
<? if ($panneau->getRoot()->hasChildren()):?>
    <br>
    <table  cellspacing="0" cellpadding="0" border="0" class="tableau" >
        <tr>
            <?php for($key = 0; $key < count($keys); $key++):?>
            <th style="background-color:#E1E1E1;"><?php echo $keys[$key];?></th>
            <?php endfor;?>
            <th style="background-color:#CCDAE7;">Nbre Panneaux</th>
            <th style="background-color:#CCDAE7;">GRP</th>
            <th style="background-color:#CCDAE7;">Couts grp</th>
            <th style="background-color:#CCDAE7;">Couts grp moyen</th>
            <th style="background-color:#CCDAE7;">Audience</th>
            <th style="background-color:#CCDAE7;">Visiblit&eacute;</th>
        </tr>
        <tr>
        <td rowspan="<?php $panneau->getNodesByDepth(1,$panneau->getRoot()); echo count($panneau->getChildsByDepth());?>"><?php echo $panneau->getRoot()->getData();?></td>
        <?foreach($panneau->getRoot()->getChildren() as $child):?>
        <td rowspan="1"><?php echo $child->getData();?></td>
        <td><center><?php echo $child->getChildAt(0)->getData();?></center></td>
        <td><center><?php echo number_format($child->getChildAt(0)->getChildAt(0)->getData(),3, ',', ' ');?></center></td>
        <td><center><?php echo number_format($child->getChildAt(0)->getChildAt(0)->getChildAt(0)->getData(),3, ',', ' ');?></center></td>
        <td><center><?php echo number_format($child->getChildAt(0)->getChildAt(0)->getChildAt(0)->getChildAt(0)->getData(),3, ',', ' ');?></center></td>
        <td><center><?php echo number_format($child->getChildAt(0)->getChildAt(0)->getChildAt(0)->getChildAt(0)->getChildAt(0)->getData(),3, ',', ' ');?></center></td>
        <td><center><?php echo number_format($child->getChildAt(0)->getChildAt(0)->getChildAt(0)->getChildAt(0)->getChildAt(0)->getChildAt(0)->getData(),3, ',', ' ');?></center></td>
        </tr>
        <tr>
        <?php endforeach;?>
        </tr>
    </table><br>
<?endif;?>
<?php endforeach;?>
</div>
<?
// save the contents of output buffer to the file
fwrite($fp, ob_get_contents());
// close the file
fclose($fp);
// Send the output to the browser
ob_end_flush(); 
?>
</div>
