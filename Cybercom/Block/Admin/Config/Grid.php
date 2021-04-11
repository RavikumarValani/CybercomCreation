<?php
namespace Block\Admin\Config;

    \Mage::loadFileByClassName('Block\Core\Template');

    class Grid extends \Block\Core\Template
    {
        protected $config = [];

        public function __construct() {
            $this->setTemplate('./view/admin/config/grid.php');
        }

        public function setConfig()
        {
            $request = \Mage::getModel('Core\Request');
            $groupId = $request->getGet('groupId');
            $config = \Mage::getModel('Config');
            $query = "SELECT * FROM `{$config->getTableName()}` WHERE `groupId` = '{$groupId}'";
            $config = $config->fetchAll($query);
            if(!$config)
            {
                return null;
            }
            $this->config =  $config;
            return $this;
        }

        public function getConfig()
        {
            if(!$this->config)
            {
                $this->setConfig();
            }
            return $this->config;
        }
    }
    
?>