<?

var_dump($panneaux);
//$this->load->library('tree');

foreach($panneaux as $panneau)
{    
    var_dump(count($panneau->getRoot()->getChildren()));
    foreach($panneau->getRoot()->getChildren() as $child)
    {
        var_dump($child->getData());
        var_dump(count($child->getChildren()));
        foreach($child->getChildren() as $grandChild)
        {
            var_dump($grandChild->getData());
            var_dump(count($grandChild->getChildren()));
            foreach($grandChild->getChildren() as $grandGrandChild)
            {
                var_dump($grandGrandChild->getData());
                var_dump(count($grandGrandChild->getChildren()));
                foreach($grandGrandChild->getChildren() as $grandGrandGrandChild)
                {
                    var_dump($grandGrandGrandChild->getData());
                    var_dump(count($grandGrandGrandChild->getChildren()));
                    foreach($grandGrandGrandChild->getChildren() as $grandGrandGrandGrandChild)
                    {
                        var_dump($grandGrandGrandGrandChild->getData());
                    }
                }
            }
        }
    }
    echo "===============================";
}

//$panneaux[1]->findChild("123","123",$panneaux[1]->getRoot());
$panneaux[0]->getNodesByDepth(1,$panneaux[0]->getRoot());
var_dump(count($panneaux[0]->getChildsByDepth()));
//var_dump($panneau->getRoot()->getdata());

echo "===============================";

//$panneaux[0]->findChild("123","123",$panneaux[0]->getRoot());
//var_dump($panneau->getRoot()->getdata());



