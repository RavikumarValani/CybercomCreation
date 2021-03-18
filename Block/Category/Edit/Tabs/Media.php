<?php
    Mage::loadFileByClassName('Block_Core_Template');
    class Block_Category_Edit_Tabs_Media extends  Block_Core_Template
    {
        public function __construct()
        {
            $this->setTemplate('./view/category/edit/tabs/media.php');
        }
    }
    
?>