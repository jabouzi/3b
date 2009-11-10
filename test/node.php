<?php
 
/** 
* Title: N-Tree Structure
* Description: Create multi-level tree strcuture in PHP 
* @author Skander Jabouzi www.skanderjabouzi.com
* @version 0.1 November 2009
*/
 
class TreeNode
{
    private $type;
    
    private $data;

    private $children; 

    function __construct($type,$data)
    {
        $this->type = $type;
        $this->data = $data;
        $this->children = array();
    }   
    
    function getType()
    {
        return $this->type;
    } 
    
    function getData()
    {
        return $this->data;
    }  
    
    function addChild($child)
    {
        if (!$this->getChild($child->getType(),$child->getData()))
        {
            $this->children[] = $child;
        }
    }  
    
    function getChildren()
    {
        return $this->children;
    }
    
    function getChild($type,$data)
    {
        $childFound = false;
        $childIndex = 0;
        foreach($this->children as $child)
        {
            if ($type == $child->type && $data == $child->data)
            {
                $childFound = $childIndex;
                break;
            }
            else
            {
                $childIndex++;
            }
        }
        return $childFound;
    }
    
    function hasChildren()
    {
        return count($this->getChildren()) > 0;
    }
    
    function getChildAt($position)
    {
        $children = $this->getChildren();
        return $children[$position];
    }
}
 
    /*public function insertLast($data)
    {
        if($this->firstNode != NULL)
        {
            $link = new ListNode($data);
            $this->lastNode->next = $link;
            $link->next = NULL;
            $this->lastNode = &$link;
            $this->count++;
        }
        else
        {
            $this->insertFirst($data);
        }
    }
 
    public function deleteFirstNode()
    {
        $temp = $this->firstNode;
        $this->firstNode = $this->firstNode->next;
        if($this->firstNode != NULL)
            $this->count--;
 
        return $temp;
    }
 
    public function deleteLastNode()
    {
        if($this->firstNode != NULL)
        {
            if($this->firstNode->next == NULL)
            {
                $this->firstNode = NULL;
                $this->count--;
            }
            else
            {
                $previousNode = $this->firstNode;
                $currentNode = $this->firstNode->next;
 
                while($currentNode->next != NULL)
                {
                    $previousNode = $currentNode;
                    $currentNode = $currentNode->next;
                }
 
                $previousNode->next = NULL;
                $this->count--;
            }
        }
    }
 
    public function deleteNode($key)
    {
        $current = $this->firstNode;
        $previous = $this->firstNode;
 
        while($current->data != $key)
        {
            if($current->next == NULL)
                return NULL;
            else
            {
                $previous = $current;
                $current = $current->next;
            }
        }
 
        if($current == $this->firstNode)
            $this->firstNode = $this->firstNode->next;
        else
            $previous->next = $current->next;
 
        $this->count--;   
    }
 
    public function find($key)
    {
        $current = $this->firstNode;
        while($current->data != $key)
        {
            if($current->next == NULL)
                return null;
            else
                $current = $current->next;
        }
        return $current;
    }
 
    public function readNode($nodePos)
    {
        if($nodePos <= $this->count)
        {
            $current = $this->firstNode;
            $pos = 1;
            while($pos != $nodePos)
            {
                if($current->next == NULL)
                    return null;
                else
                    $current = $current->next;
 
                $pos++;
            }
            return $current->data;
        }
        else
            return NULL;
    }
 
    public function totalNodes()
    {
        return $this->count;
    }
 
    public function readList()
    {
        $listData = array();
        $current = $this->firstNode;
 
        while($current != NULL)
        {
            array_push($listData, $current->readNode());
            $current = $current->next;
        }
        return $listData;
    }
 
    public function reverseList()
    {
        if($this->firstNode != NULL)
        {
            if($this->firstNode->next != NULL)
            {
                $current = $this->firstNode;
                $new = NULL;
 
                while ($current != NULL)
                {
                    $temp = $current->next;
                    $current->next = $new;
                    $new = $current;
                    $current = $temp;
                }
                $this->firstNode = $new;
            }
        }
    }
}*/
 
?>
