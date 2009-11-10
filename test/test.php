<?

require_once("tree.php");

$tree = new TreeStructure();
$tree->addRoot("root","testRoot");
$tree->insertRootChild("child","firstChild");
$tree->insertRootChild("child","secondChild");

var_dump($tree);
var_dump($tree->getRoot()->getChildren());

var_dump($tree->getRoot()->getChild("child","secondChild"));

var_dump($tree->getRoot()->hasChildren());
var_dump($tree->getRoot()->getChildAt(0)->hasChildren());
