<?

require_once("tree.php");

$tree = new TreeStructure();
$tree->addRoot("root","testRoot");
$tree->insertRootChild("child","firstChild");
$tree->insertRootChild("child","secondChild");
$tree->insertChild("child2","firstGrandChild",$tree->getRoot()->getChildAt(0));
$tree->insertChild("child2","secondGrandChild",$tree->getRoot()->getChildAt(0));
$tree->insertChild("child3","xFirstGrandChild",$tree->getRoot()->getChildAt(0)->getChildAt(1));


var_dump($tree);
var_dump($tree->getRoot()->getChildren());
echo "===============================";
var_dump($tree->getRoot()->getChild("child","secondChild"));

var_dump($tree->getRoot()->hasChildren());
//var_dump($tree->getRoot()->getChildAt(0)->getChildren());
var_dump($tree->getRoot()->getChildAt(0)->getChildAt(1)->getChildren());
//var_dump($tree->getRoot()->getChildAt(1)->hasChildren());
echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
$res = $tree->findChild("child3","xFirstGrandChild",$tree->getRoot());
var_dump($res);

//var_dump($tree->getNodesByDepth(2,$tree->getRoot()));
