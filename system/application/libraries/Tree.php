<?

/** 
* Title: N-Tree Structure
* Description: Create multi-level tree strcuture in PHP 
* @author Skander Jabouzi www.skanderjabouzi.com
* @version 0.1 November 2009
*/

require_once("Node.php");

class Tree
{
    private $root;
 
    private $count;
    
    private $depth;
    
    private $childFound;
    
    private $childsByDepth;
 
    function __construct()
    {
        $this->root = NULL;
        $this->count = 0;
        $this->setDepth(0);
        $this->childFound = false;
        $this->childsByDepth = array();
    }
 
    public function isEmpty()
    {
        return (NULL == $this->root);
    } 
    
    function addRoot($type,$data)
    {
        $node = new Node($type,$data,0);
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
    
    function getChildFound()
    {
        return $this->childFound;
    }    
    
    function getChildsByDepth()
    {
        return $this->childsByDepth;
    }     
    
    function getGrandChildren($node)
    {
        $grandChildren = array();
        foreach($node->getChildren() as $child)
        {
            foreach($child->getChildren() as $grandChild)
            {
                $grandChildren[] = $grandChild;
            }
        }
        return $grandChildren;
    }
    
    function incrementCount()
    {
        $this->count = $this->count + 1;
    }   
    
    function setDepth($newDepth)
    {
        $this->depth = $newDepth;
    }
    
    function resetChildsByDepth()
    {
        $this->childsByDepth = false;
    }
    
    
    function insertRootChild($type,$data)
    {
        $node = new Node($type,$data,1);         
        $this->incrementCount();   
        return $this->root->addChild($node);    
    }
    
    function insertChild($type,$data,$node)
    {
        $childDepth = $node->getDepth() + 1;
        $child = new Node($type,$data,$childDepth);         
        $this->incrementCount();     
        if ($childDepth > $this->getDepth())
        {
            $this->setDepth($childDepth);
        }
        return $node->addChild($child);  
    }    
    
    function getNodesByDepth($depth,$node)
    {
        if ($depth == $node->getDepth())
        {
            $this->childsByDepth[] = $node;
        }
        else
        {
            foreach($node->getChildren() as $child)
            {
                $this->getNodesByDepth($depth,$child); 
            }
        }
    }
    
    function findChild($data,$type,$node)
    {
        $this->childFound = false;
        if ($node->getChild($data,$type))
        {
            $this->childFound = $node->getChild($data,$type);
        }
        else
        { 
            foreach ($node->getChildren() as $child)
            {                
                $this->findChild($data,$type,$child);
            }
        }

    }
}
