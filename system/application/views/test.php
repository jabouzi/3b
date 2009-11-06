<?

$indice = $panneaux['count'];
for ($i = 0; $i < count($panneaux); $i++)
{
    for ($j = 0; $j < count($panneaux[$i]); $j++)
    {
        $raw[$i] = count($panneaux[$i]);
    }
    
}
var_dump($raw);
print_r($panneaux);
var_dump($panneaux);

?>
