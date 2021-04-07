<?php
namespace Block\Admin\Config\Edit\Tabs;

    \Mage::loadFileByClassName('Block\Core\Edit\Tabs');

    class Configuration extends  \Block\Core\Edit\Tabs
    {
        public function __construct()
        {
            $this->setTemplate('./view/admin/config/edit/tabs/configuration.php');
        }
    }
    
?>