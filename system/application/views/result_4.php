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
        <?php 
            $panneau->getNodesByDepth(1,$panneau->getRoot()); $count1 = count($panneau->getChildsByDepth());
            foreach($panneau->getChildsByDepth() as $p)
            {
                var_dump($p->getData());
            }     
            echo"------------------------------";       
            $panneau->resetChildsByDepth();
            $panneau->getNodesByDepth(2,$panneau->getRoot()); $count2 = count($panneau->getChildsByDepth());
            foreach($panneau->getChildsByDepth() as $p)
            {
                var_dump($p->getData());
                var_dump($p->getChildren());                
            }   
            echo"------------------------------"; 
            $panneau->resetChildsByDepth();
            $panneau->getNodesByDepth(3,$panneau->getRoot()); $count3 = count($panneau->getChildsByDepth());
            foreach($panneau->getChildsByDepth() as $p)
            {
                var_dump($p->getData());
            }   
            echo"------------------------------"; 
            var_dump($count1);
            var_dump($count2);
            var_dump($count3);
        ?>
        <td rowspan="<?php echo $count1*$count2*$count3;?>"><?php echo $panneau->getRoot()->getData();?></td>
        <?foreach($panneau->getRoot()->getChildren() as $child):?>
        <td rowspan="<?php echo count($child->getChildren())?>"><?php echo $child->getData();?></td>
        <?foreach($child->getChildren() as $grandChild):?>
        <td rowspan="<?php echo count($grandChild->getChildren());?>"><?php echo $grandChild->getData();?></td>
        <?foreach($grandChild->getChildren() as $grandGrandChild):?>
        <td><?php echo $grandGrandChild->getData();?></td>
        <td><center><?php echo $grandGrandChild->getChildAt(0)->getData();?></center></td>
        <td><center><?php echo number_format($grandGrandChild->getChildAt(0)->getChildAt(0)->getData(),3, ',', ' ');?></center></td>         
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
