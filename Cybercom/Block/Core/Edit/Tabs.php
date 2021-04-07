<?php
namespace Block\Core\Edit;

    \Mage::loadFileByClassName("Block\Core\Template");
    
    class Tabs extends \Block\Core\Template
    {
        protected $tableRow = null;

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/core/edit/tabs.php');
            $this->prepareTab();
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

        public function prepareTab()
        {
            return $this;
        }
        
    }
    
    ?>