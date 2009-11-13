<?

require_once("tree.php");

$tree = new TreeStructure();
$tree->addRoot("root","testRoot");
var_dump($tree->insertRootChild("child","firstChild"));
var_dump($tree->insertRootChild("child","secondChild"));
var_dump($tree->insertChild("child2","firstGrandChild",$tree->getRoot()->getChildAt(0)));
var_dump($tree->insertChild("child2","secondGrandChild",$tree->getRoot()->getChildAt(0)));
var_dump($tree->insertChild("child3","xFirstGrandChild",$tree->getRoot()->getChildAt(0)->getChildAt(1)));
var_dump($tree->insertChild("child4","xxFirstGrandChild",$tree->getRoot()->getChildAt(0)->getChildAt(1)->getChildAt(0)));
var_dump($tree->insertChild("child4","xxSecondGrandChild",$tree->getRoot()->getChildAt(0)->getChildAt(1)->getChildAt(0)));


var_dump($tree);
var_dump($tree->getRoot()->getChildren());
echo "===============================";
var_dump($tree->getRoot()->getChild("child","secondChild"));

var_dump($tree->getRoot()->hasChildren());
//var_dump($tree->getRoot()->getChildAt(0)->getChildren());
var_dump($tree->getRoot()->getChildAt(0)->getChildAt(1)->getChildren());
//var_dump($tree->getRoot()->getChildAt(1)->hasChildren());
echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
$tree->findChild("child3","xFirstGrandChild",$tree->getRoot());
var_dump($tree->getChildFound());
$tree->insertChild("child4","xyfirstGrandChild",$tree->getChildFound());

$tree->getNodesByDepth(4,$tree->getRoot());
var_dump($tree->getChildsByDepth());
