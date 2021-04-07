<?php
namespace Block\Admin\Config;

    \Mage::loadFileByClassName("Block\Core\Edit");

    class Edit extends \Block\Core\Edit
    {
        protected $attribute = null;

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/core/edit.php');
        }
        
       
    }
    
?>