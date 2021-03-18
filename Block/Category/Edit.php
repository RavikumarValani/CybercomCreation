<?php
    Mage::loadFileByClassName("Block_Core_Template");
    class Block_Category_Edit extends Block_Core_Template 
    {
        protected $category = null;

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/category/edit.php');
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
            $this->setTitle('Add Category');

            if($id = (int) $this->getRequest()->getGet('categoryId'))
            {
                $this->setTitle('Update Category');
            }
            return $this->getTitle();
        }

    }
    
?>