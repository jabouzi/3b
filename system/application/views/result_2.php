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
        </tr>
        <tr>
        <td rowspan="<?php $panneau->getNodesByDepth(1,$panneau->getRoot()); echo count($panneau->getChildsByDepth());?>"><?php echo $panneau->getRoot()->getData();?></td>
        <?foreach($panneau->getRoot()->getChildren() as $child):?>
        <td rowspan="1"><?php echo $child->getData();?></td>
        <td><?php echo $child->getChildAt(0)->getData();?></td>
        <td><?php echo $child->getChildAt(0)->getChildAt(0)->getData();?></td>
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
