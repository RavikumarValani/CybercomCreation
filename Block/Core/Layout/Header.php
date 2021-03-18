<?php

    Mage::loadFileByClassName('Block_Core_Template');

    class Block_Core_Layout_Header extends Block_Core_Template
    {
        public function __construct()
        {
            parent::__construct();
            $this->setTemplate("./view/core/layout/header.php");
        }
    }
    
?>