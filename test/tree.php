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
        $this->setDepth(0);
    }
 
    public function isEmpty()
    {
        return (NULL == $this->root);
    } 
    
    function addRoot($type,$data)
    {
        $node = new TreeNode($type,$data,0);
        $this->root = $node;
        $this->incrementCount();
    }    
    
    function getRoot()
    {
        return $this->root;
    }
    
    function getCount()
    {
        return $this->count;
    }
    
    function getDepth()
    {
        return $this->depth;
    }
    
    function incrementCount()
    {
        $this->count = $this->count + 1;
    }   
    
    function setDepth($newDepth)
    {
        $this->depth = $newDepth;
    }
    
    
    function insertRootChild($type,$data)
    {
        $node = new TreeNode($type,$data,1);
        $this->root->addChild($node);    
        $this->incrementCount();    
    }
    
    function insertChild($type,$data,$node)
    {
        $childDepth = $node->getDepth() + 1;
        $child = new TreeNode($type,$data,$childDepth);
        $node->addChild($child);   
        $this->incrementCount();     
        if ($childDepth > $this->getDepth())
        {
            $this->setDepth($childDepth);
        }
    }    
    
    function getNodesByDepth($depth,$node)
    {
        if (0 == $depth)
        {
            $nodes[] = $this->getRoot();
            $count = 1;
        }
        else
        {
            foreach($node->getChildren() as $child)
            {
                if ($depth == $child->getDepth())
                {
                    var_dump($child->getData());
                    $nodes[] = $child;
                    $count = $count + 1;
                }
                else
                {
                    $this->getNodesByDepth($depth,$child);
                }
                
            }
        }
        return $count;
    }
    
    function findChild($data,$type,$node)
    {
        //$childFound = false;
        if ($node->getChild($data,$type))
        {
            return  $child->getChild($data,$type);
        }
        else
        {
            if ($node->hasChildren())
            {
                foreach ($node->getChildren() as $child)
                {
                    var_dump($child->getData());
                    if ($child->getChild($data,$type))
                    {
                        var_dump("ok");
                        return  $child->getChild($data,$type);
                    }
                    else
                    {
                        $this->findChild($data,$type,$child);                
                    }
                }
            }
        }
        //return $childFound;
    }
}
