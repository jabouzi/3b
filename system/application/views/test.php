<?

$temp = 0;
$raw = array();
for ($i = 1; $i < count($panneaux); $i++)
{
    if ($panneaux[$temp]['annonceur'] == $panneaux[$i]['annonceur'])
    {
        if ($panneaux[$temp]['compagne'] == $panneaux[$i]['compagne'])
        $raw[$temp] == $raw[$temp] + 1;
    }
    else
    {
        $temp = $i;
    }
}




//$indice = $panneaux['count'];
//$raw1 = array();
/*for ($i = 0; $i < count($panneaux); $i++)
{
    $raw[$i] = count($panneaux[$i]);
    for ($j = 0; $j < count($panneaux[$i]); $j++)
    {
        $raw[$i][$j] = count($panneaux[$j]);          
    }    
}*/
/*$i = 0;
$j = 0;
foreach ($panneaux as $panneau)
{   
    $raw1[$i] = count($panneau);   
    //var_dump($panneau[$i][0]['annonceur']);
    foreach($panneau as $pann)
    {
        foreach($pann as $p)
        {
            var_dump($p['annonceur']);
        }
        //var_dump($p[0]['annonceur']);
        $raw2[$i][$j] = count($pann);
        $j++;
    }
    $i++;
}
var_dump($raw1);*/
//var_dump($raw2);
//print_r($panneaux);
var_dump($panneaux);

/*
$i = 0;
$j = 0;
?>
<?foreach ($panneaux as $panneau):?>
<br><table border=1 class="table" >
    <tr>
    <?php for($key = 0; $key < count($keys); $key++):?>
    <th style="background-color:#7F7F7F;" class="th"><?php echo $keys[$key];?></th>
    <?php endfor;?>
    <th style="background-color:red;" class="thres">Nbre Panneaux</th>
    <th style="background-color:red;" class="thres">GRP</th>
    </tr>
    <?foreach ($panneau as $pnn):?>
    <?foreach ($pann as $p):?>
    <tr>    
    <td rowspan="<?php echo $raw1[$i];?>"><?php echo $p['annonceur'];?></td>        
    </tr>
    <?php endforeach;?>
    <?php endforeach;?>
    </table><br>
    <?$i++;?>
<?php endforeach;?>

<?php echo '</div';?>*/
