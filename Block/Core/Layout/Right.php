<?php

    Mage::loadFileByClassName('Block_Core_Template');

    class Block_Core_Layout_Right extends Block_Core_Template
    {
        public function __construct()
        {
            $this->setTemplate("./view/core/layout/right.php");
        }
    }
    
?>