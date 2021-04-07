<?php
namespace Model\Customer;

    \Mage::loadFileByClassName("Model\Core\Table");

    class Group extends \Model\Core\Table
    {
        public function __construct()
        {
            $this->setTableName('customer_group');
            $this->setPrimaryKey('groupId');
        }
    }
    
?>