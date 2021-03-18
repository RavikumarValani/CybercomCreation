<?php
    Mage::loadFileByClassName('Block_Core_Template');
    class Block_Index_Index extends Block_Core_Template
    {
        public function __construct()
        {
            $this->setTemplate('./view/index/index.php');
        }
    }
    
?>