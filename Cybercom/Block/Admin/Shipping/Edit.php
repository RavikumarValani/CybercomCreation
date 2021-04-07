<?php
namespace Block\Admin\Shipping;

    \Mage::loadFileByClassName("Block\Core\Template");

    class Edit extends \Block\Core\Template
    {
        protected $shipping = null;

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/admin/shipping/edit.php');
        }
        
        
    }
    
?>