<?

require_once("node.php");

class TreeStructure
{
    
    private $root;
 
    private $count;
    
    private $depth;
 
    function __construct()
    {
        $this->root = NULL;
        $this->count = 0;
        $this->depth = 0;
    }
 
    public function isEmpty()
    {
        return (NULL == $this->root);
    } 
    
    function addRoot($type,$data)
    {
        $node = new TreeNode($type,$data);
        $this->root = $node;
        $this->incrementCount();
    }    
    
    function getRoot()
    {
        return $this->root;
    }
    
    function incrementCount()
    {
        $this->count = $this->count + 1;
    }
    
    function incrementDepth()
    {
        $this->depth = $this->depth + 1;
    }
    
    function getCount()
    {
        return $this->count;
    }
    
    function getDepth()
    {
        return $this->depth;
    }
    
    function insertRootChild($type,$data)
    {
        $node = new TreeNode($type,$data);
        $this->root->addChild($node);
        if (1 != $this->getDepth())
        {
            $this->incrementDepth();
        }
    }
    
    function findChild($data,$type,$node)
    {
        $childFound = false;
        foreach ($node->getChildren() as $child)
        {
            if (!$child->getChild($data,$type))
            {
                $this->findChild($data,$type,$child);
            }
            else
            {
                $childFound =  &$child;
            }
        }
        return $childFound;
    }
}
