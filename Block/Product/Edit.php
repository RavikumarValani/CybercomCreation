<?php
    Mage::loadFileByClassName("Block_Core_Template");
    class Block_Product_Edit extends Block_Core_Template
    {

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/product/edit.php');
        }
        public function getTabContent()
        {
            $tabClassName = get_class($this)."_Tabs";
            $tabClassName = str_replace("Block_",'',$tabClassName);
            $tabBlock = Mage::getBlock($tabClassName); 
            $tabs = $tabBlock->getTabs();
            $tab = $this->getRequest()->getGet('tab', $tabBlock->getDefaultTab());
            if(!array_key_exists($tab, $tabs))
            {
                return null;
            }
            $blockClassName = $tabs[$tab]['block']; 
            $blockClassName = str_replace("Block_",'',$blockClassName);
            $block = Mage::getBlock($blockClassName);
            echo $block->toHtml();
        }
        public function getFormUrl()
        {
            return $this->getUrl()->getUrl('save');
        }

        public function getHeading()
        {
            $this->setTitle('Add Product');

            if($id = (int) $this->getRequest()->getGet('id'))
            {
                $this->setTitle('Update Product');
            }
            return $this->getTitle();
        }
        
       
    }
    
?>