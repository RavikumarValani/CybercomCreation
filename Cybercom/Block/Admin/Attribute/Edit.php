<?php
namespace Block\Admin\Attribute;

    \Mage::loadFileByClassName("Block\Core\Edit");

    class Edit extends \Block\Core\Edit
    {

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/admin/attribute/edit.php');
        }
        
       
    }
    
?>