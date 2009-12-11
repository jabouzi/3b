<?php
/*Skander Jabouzi 2009 result.php : afficher le tableau croisé et le cacher dans fichier*/

ob_start();
$cachefile  = "./system/application/views/result_cached.php";  
$fp = fopen($cachefile, 'w');              
?>
<?php  foreach($panneaux as $panneau):?>
<? if ($panneau->getRoot()->hasChildren()):?>
    <br>
    <table border=1 class="table" >
        <tr>
            <?php for($key = 0; $key < count($keys); $key++):?>
            <th style="background-color:#7F7F7F;" class="th"><?php echo $keys[$key];?></th>
            <?php endfor;?>
            <th style="background-color:red;" class="thres">Nbre Panneaux</th>
            <th style="background-color:red;" class="thres">GRP</th>
            <th style="background-color:red;" class="thres">Couts grp</th>
            <th style="background-color:red;" class="thres">Couts grp moyen</th>
            <th style="background-color:red;" class="thres">Audience</th>
            <th style="background-color:red;" class="thres">Visiblit&eacute;</th>            
        </tr>
        <tr>
        <?php 
            $panneau->getNodesByDepth(1,$panneau->getRoot()); $count1 = count($panneau->getChildsByDepth());
            $panneau->resetChildsByDepth();
            $panneau->getNodesByDepth(2,$panneau->getRoot()); $count2 = count($panneau->getChildsByDepth());
        ?>
        <td rowspan="<?php echo $count1*$count2?>"><?php echo $panneau->getRoot()->getData();?></td>
        <?foreach($panneau->getRoot()->getChildren() as $child):?>
        <td rowspan="<?php echo count($child->getChildren());?>"><?php echo $child->getData();?></td>
        <?foreach($child->getChildren() as $grandChild):?>
        <td><?php echo $grandChild->getData();?></td>
        <td><center><?php echo $grandChild->getChildAt(0)->getData();?></center></td>
        <td><center><?php echo number_format($grandChild->getChildAt(0)->getChildAt(0)->getData(),3, ',', ' ');?></center></td>        
        <td><center><?php echo number_format($grandChild->getChildAt(0)->getChildAt(0)->getChildAt(0)->getData(),3, ',', ' ');?></center></td>
        <td><center><?php echo number_format($grandChild->getChildAt(0)->getChildAt(0)->getChildAt(0)->getChildAt(0)->getData(),3, ',', ' ');?></center></td>
        <td><center><?php echo number_format($grandChild->getChildAt(0)->getChildAt(0)->getChildAt(0)->getChildAt(0)->getChildAt(0)->getData(),3, ',', ' ');?></center></td>
        <td><center><?php echo number_format($grandChild->getChildAt(0)->getChildAt(0)->getChildAt(0)->getChildAt(0)->getChildAt(0)->getChildAt(0)->getData(),3, ',', ' ');?></center></td>
        </tr>        
        <tr>        
        <?php endforeach;?>
        </tr>   
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

        <!--<td rowspan="<?php //echo $count2?>"><?php //echo $panneau->getRoot()->getData();?></td>
        <?//foreach($panneau->getRoot()->getChildren() as $child):?>
        <?//$panneau->resetChildsByDepth();?>
        <?//$panneau->getNodesByDepth(2,$child); $count = count($panneau->getChildsByDepth());?>
        <td rowspan="<?php //echo $count?>"><?php //echo $child->getData();?></td>
        <?//foreach($child->getChildren() as $grandChild):?>
        <td><?php //echo $grandChild->getData();?></td>
        <td><center><?php //echo $grandChild->getChildAt(0)->getData();?></center></td>
        <td><center><?php //echo number_format($grandChild->getChildAt(0)->getChildAt(0)->getData(),3, ',', ' ');?></center></td>-->
