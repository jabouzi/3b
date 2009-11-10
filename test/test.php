<?

require_once("tree.php");

$tree = new TreeStructure();
$tree->addRoot("root","testRoot");
$tree->insertRootChild("child","firstChild");
$tree->insertRootChild("child","secondChild");

var_dump($tree);
var_dump($tree->getRoot()->getChildren());

