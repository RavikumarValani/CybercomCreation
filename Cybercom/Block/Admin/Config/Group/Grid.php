<?php
namespace Block\Admin\Config\Group;

    \Mage::loadFileByClassName('Block\Core\Template');

    class Grid extends \Block\Core\Template
    {
        protected $config = [];

        public function __construct() {
            $this->setTemplate('./view/admin/config/group/grid.php');
        }

        public function setConfig(\Model\Config $config)
        {
            $this->config = $config;
            return $this;
        }
        public function getConfig()
        {
            return $this->config;
        }
    }
    
?>