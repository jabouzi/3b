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

