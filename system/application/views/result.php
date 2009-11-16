<?php
/*Skander Jabouzi 2009 result.php : afficher le tableau croisé et le cacher dans fichier*/

ob_start();
$cachefile  = "./system/application/views/result_cached.php";  
$fp = fopen($cachefile, 'w');              
?>
<?php 
    $rowspan = array();
    for ($index = 0; $index < count($keys); $index++)
    {
        if ($index == count($keys) - 1) $rowspan[$index] = 1;
        else
        {
           $res = 1;
           for ($indice = $index + 1; $indice < count($keys); $indice++)
           {
               $res *= count($data[$keys[$indice]]);
           }
           $rowspan[$index] = $res;
        }
    }
    $arr = $data[$keys[0]];
    $nbre = 0;
    $index = 0;
?>
<?php  foreach($arr as $item0):?>
    <br><table border=1 class="table" >
    <tr>
    <?php for($key = 0; $key < count($keys); $key++):?>
    <th style="background-color:#7F7F7F;" class="th"><?php echo $keys[$key];?></th>
    <?php endfor;?>
    <th style="background-color:red;" class="thres">Nbre Panneaux</th>
    <th style="background-color:red;" class="thres">GRP</th>
    </tr>
    <tr>
    <td rowspan="<?php echo $rowspan[0];?>"><?php echo $item0;?></td>
    <?php if (isset($keys[1])):?>
        <?php for($i = 0; $i < count($data[$keys[1]]); $i++):?>    
            <td rowspan="<?php echo $rowspan[1];?>"><?php echo $data[$keys[1]][$i];?></td>
            <?php if (isset($keys[2])):?>           
                <?php for($j = 0; $j < count($data[$keys[2]]); $j++):?>
                    <td rowspan="<?php echo $rowspan[2];?>"><?php echo $data[$keys[2]][$j];?></td>
                    <?php if (isset($keys[3])):?>   
                        <?php for($k = 0; $k < count($data[$keys[3]]); $k++):?>
                            <td rowspan="<?php echo $rowspan[3];?>"><?php echo $data[$keys[3]][$k];?></td>
                            <?php if (isset($keys[4])):?>   
                                <?php for($l = 0; $l < count($data[$keys[4]]); $l++):?>
                                    <td rowspan="<?php echo $rowspan[4];?>"><?php echo $data[$keys[4]][$l];?></td>
                                    <?php if (isset($keys[5])):?>   
                                        <?php for($m = 0; $m < count($data[$keys[5]]); $m++):?>                            
                                            <td rowspan="<?php echo $rowspan[5];?>"><?php echo $data[$keys[5]][$m];?></td>
                                            <td rowspan="<?php echo $rowspan[5];?>"><?php echo $panneaux[$nbre++]['nbre'];?></td>
                                            <td rowspan="<?php echo $rowspan[5];?>"><?php echo $panneaux[$nbre-1]['grp'];?></td>
                                            </tr>
                                            <tr>
                                        <?php endfor;?>
                                    <?php else:?>
                                    <td style="padding:20;" rowspan="<?php echo $rowspan[4];?>"><?php echo $panneaux[$nbre++]['nbre'];?></td>
                                    <td style="padding:20;" rowspan="<?php echo $rowspan[4];?>"><?php echo $panneaux[$nbre-1]['grp'];?></td>
                                    </tr>
                                    <tr>
                                    <?php endif;?>
                                <?php endfor;?>
                            <?php else:?>
                            <td style="padding:20;" rowspan="<?php echo $rowspan[3];?>"><?php echo $panneaux[$nbre++]['nbre'];?></td>
                            <td style="padding:20;" rowspan="<?php echo $rowspan[3];?>"><?php echo $panneaux[$nbre-1]['grp'];?></td>
                            </tr>
                            <tr>
                            <?php endif;?>
                        <?php endfor;?>
                    <?php else:?>
                    <td style="padding:20;" rowspan="<?php echo $rowspan[2];?>"><?php echo $panneaux[$nbre++]['nbre'];?></td>
                    <td style="padding:20;" rowspan="<?php echo $rowspan[2];?>"><?php echo $panneaux[$nbre-1]['grp'];?></td>
                    </tr>
                    <tr>
                    <?php endif;?>
                <?php endfor;?>
            <?php else:?>
            <td style="padding:20;" rowspan="<?php echo $rowspan[1];?>"><?php echo $panneaux[$nbre++]['nbre'];?></td>
            <td style="padding:20;" rowspan="<?php echo $rowspan[1];?>"><?php echo $panneaux[$nbre-1]['grp'];?></td>
            </tr>
            <tr>
            <?php endif;?>
        <?php endfor;?>
    <?php else:?>
    <td style="padding:20;" rowspan="<?php echo $rowspan[0];?>"><?php echo $panneaux[$nbre++]['nbre'];?></td>
    <td style="padding:20;" rowspan="<?php echo $rowspan[0];?>"><?php echo $panneaux[$nbre-1]['grp'];?></td>
    </tr>
    <tr>
    <?php endif;?>
    </tr>
    </table><br>
<?php endforeach;?>

<?php echo '</div';?>
<?php
// save the contents of output buffer to the file
fwrite($fp, ob_get_contents());
// close the file
fclose($fp);
// Send the output to the browser
ob_end_flush(); 
?>
</div>

