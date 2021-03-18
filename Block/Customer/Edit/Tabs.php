<?php 
    Mage::loadFileByClassName('Block_Core_Template');

    class Block_Customer_Edit_Tabs extends Block_Core_Template
    {
        protected $tabs = [];
        protected $defaultTab = null;

        public function __construct()
        {
            $this->setTemplate("./view/customer/edit/tabs.php");
            $this->prepareTab();
        }
        public function prepareTab()
        {
            $this->addTab('customer',['label' => 'Customer Information','default' => true, 'block' => 'Block_Customer_Edit_Tabs_Form']);
            $this->addTab('Address',['label' => 'Addresses','default' => true, 'block' => 'Block_Customer_Edit_Tabs_Address']);
            $this->setDefaultTab('customer');
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