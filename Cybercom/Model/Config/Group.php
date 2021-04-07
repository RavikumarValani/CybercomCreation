<?php
namespace Model\Config;

    \Mage::loadFileByClassName("Model\Core\Table");
    
    class Group extends \Model\Core\Table
    {

        public function __construct()
        {
            $this->setTableName('config_group');
            $this->setPrimaryKey('entityId');
        }
    }
?>