class TreeStructure
{
    
    private $root
 
    private $count;
    
    private $depth
 
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
        $node = new $treeNode($type,$data);
        $this->root = $node;
        $this->count = $this->count + 1;
    }    
    
    function insertRootChild($type,$data)
    {
        $node = new $treeNode($type,$data);
        $this->root->children[] = $node;
        $this->depth = $this->depth  + 1;
    }
    
    function findChild($data,$type)
    {
        for ($i = 0; $i < $this->depth; $i++)
        {
            if ($type == $this->root->children[0]->type)
            {
                for ($j = 0; $j < count($this->root->children); $j++)
                {
                    if ($data == $this->root->children[$j]->data)
                    {
                        $nodeFound = &$this->root->children[$j];
                        break 2;                        
                    }
                }
            }
        }
        return $nodeFound;
    }
