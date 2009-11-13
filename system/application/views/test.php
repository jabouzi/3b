<?

var_dump($panneaux);
//$this->load->library('tree');
foreach($panneaux as $panneau)
{
    var_dump($panneau->getRoot()->getdata());
    foreach($panneau->getRoot()->getChildren() as $child)
    {
        var_dump($child->getData());
        foreach($child->getChildren() as $grandChild)
        {
            var_dump($grandChild->getData());
        }
    }
}


