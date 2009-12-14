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
        <?php            
            $panneau->getNodesByDepth(3,$panneau->getRoot()); $count = count($panneau->getChildsByDepth());  
        ?>
        <td rowspan="<?php echo $count;?>"><?php echo $panneau->getRoot()->getData();?></td>
        <?foreach($panneau->getRoot()->getChildren() as $child):?>
        <?$panneau->resetChildsByDepth();?>
        <?$panneau->getNodesByDepth(3,$child); $count = count($panneau->getChildsByDepth());?>
        <td rowspan="<?php echo $count;?>"><?php echo $child->getData();?></td>
        <?foreach($child->getChildren() as $grandChild):?>
        <td rowspan="<?php echo count($grandChild->getChildren());?>"><?php echo $grandChild->getData();?></td>
        <?foreach($grandChild->getChildren() as $grandGrandChild):?>
        <td><?php echo $grandGrandChild->getData();?></td>
        <td><center><?php echo $grandGrandChild->getChildAt(0)->getData();?></center></td>
        <td><center><?php echo number_format($grandGrandChild->getChildAt(0)->getChildAt(0)->getData(),3, ',', ' ');?></center></td>         
        <td><center><?php echo number_format($grandGrandChild->getChildAt(0)->getChildAt(0)->getChildAt(0)->getData(),3, ',', ' ');?></center></td>
        <td><center><?php echo number_format($grandGrandChild->getChildAt(0)->getChildAt(0)->getChildAt(0)->getChildAt(0)->getData(),3, ',', ' ');?></center></td>
        <td><center><?php echo number_format($grandGrandChild->getChildAt(0)->getChildAt(0)->getChildAt(0)->getChildAt(0)->getChildAt(0)->getData(),3, ',', ' ');?></center></td>
        <td><center><?php echo number_format($grandGrandChild->getChildAt(0)->getChildAt(0)->getChildAt(0)->getChildAt(0)->getChildAt(0)->getChildAt(0)->getData(),3, ',', ' ');?></center></td>
        </tr>        
        <?php endforeach;?>
        <?php endforeach;?>
        <tr>        
        <?php endforeach;?>
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
