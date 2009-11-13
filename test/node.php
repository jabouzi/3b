<?php
 
/** 
* Title: Tree Node Structure
* Description: a tree node strcuture in PHP 
* @author Skander Jabouzi www.skanderjabouzi.com
* @version 0.1 November 2009
*/
 
class TreeNode
{
    private $type;
    
    private $data;    
        
    private $depth; 

    private $children; 
   

    function __construct($type,$data,$depth)
    {
        $this->type = $type;
        $this->data = $data;
        $this->depth = $depth;
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
    
    function getDepth()
    {
        return $this->depth;
    }
    
    function getChildren()
    {
        return $this->children;
    }
    
    function addChild($child)
    {
        if (!$this->getChild($child->getType(),$child->getData()))
        {
            $this->children[] = $child;
        }
        return count($this->children) - 1;
    }  
    
    function getChild($type,$data)
    {
        $childFound = false;
        foreach($this->children as $child)
        {
            if ($type == $child->type && $data == $child->data)
            {
                $childFound = $child;
                break;
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

