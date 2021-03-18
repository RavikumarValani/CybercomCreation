<?php 
    Mage::loadFileByClassName('Block_Core_Template');

    class Block_Product_Edit_Tabs extends Block_Core_Template
    {
        protected $tabs = [];
        protected $defaultTab = null;

        public function __construct()
        {
            $this->setTemplate("./view/product/edit/tabs.php");
            $this->prepareTab();
        }
        public function prepareTab()
        {
            $this->addTab('product',['label' => 'Product info','default' => true, 'block' => 'Block_Product_Edit_Tabs_Form']);
            $this->addTab('category',['label' => 'Category info','default' => true, 'block' => 'Block_Product_Edit_Tabs_Category']);
            $this->addTab('Media',['label' => 'Media','default' => true, 'block' => 'Block_Product_Edit_Tabs_Media']);
            $this->setDefaultTab('product');
            return $this;
        }

        public function setDefaultTab($defaultTab)
        {
            $this->defaultTab = $defaultTab;
            return $this;
        }
        public function getDefaultTab()
        {
            return $this->defaultTab;
        }
        public function setTabs(array $tabs)
        {
            $this->tabs = $tabs;
            return $this;
        }

        public function getTabs()
        {
            return $this->tabs;
        }

        public function addTab($key, $tab = [])
        {
            $this->tabs[$key] = $tab;
            return $this;
        }

        public function getTab($key)
        {
            if(!array_key_exists($key, $this->tabs))
            {
                return null;
            }
            return $this->tabs[$key];
        }

        public function removeTab($key)
        {
            if(array_key_exists($key, $this->tabs))
            {
                unset($this->tabs[$key]);
            }
            return $this;
        }
    }
    
?>