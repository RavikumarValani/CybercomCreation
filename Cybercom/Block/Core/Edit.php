<?php
namespace Block\Core;

    \Mage::loadFileByClassName("Block\Core\Template");

    class Edit extends \Block\Core\Template
    {
        protected $tabClass = null;
        protected $tableRow = null;
        protected $tab = null;

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/core/edit.php');
        }
        
        public function setTabClass($tabClass)
        {
            $this->tabClass = $tabClass;
            return $this;
        }
        public function getTabClass()
        {
            return $this->tabClass;
        }
        
        public function setTableRow(\Model\Core\Table $tableRow)
        {
            $this->tableRow = $tableRow;
            return $this;
        }
        public function getTableRow()
        {
            return $this->tableRow;
        }
        
        public function setTab($tab = null)
        {
            if(!$tab)
            {
                $tab = $this->getTabClass();
            }
            $tab->setTableRow($this->getTableRow());
            $this->tab = $tab;
            return $this;
        }
        public function getTab()
        {
            if(!$this->tab)
            {
                $this->setTab();
            }
            return $this->tab;
        }
        
        public function getTabHtml()
        {
            return $this->getTab()->toHtml();
        }

        public function getFormUrl()
        {
            return $this->getUrl()->getUrl('save');
        }
        
        public function getTabContent()
        {
            $tabBlock = $this->getTab(); 
            $tabs = $tabBlock->getTabs();
            
            $tab = $this->getRequest()->getGet('tab', $tabBlock->getDefaultTab());
            if(!array_key_exists($tab, $tabs))
            {
                return null;
            }
            $blockClassName = $tabs[$tab]['block'];
            $blockClassName = str_replace("Block\\",'',$blockClassName);
            $block = \Mage::getBlock($blockClassName)->setTableRow($this->getTableRow());
            echo $block->toHtml();
        }
        
    }
    
    ?>