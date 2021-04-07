<?php
namespace Model\Order;

    \Mage::loadFileByClassName("Model\Core\Table");

    class Address extends \Model\Core\Table
    {
        public function __construct()
        {
            $this->setTableName('orderaddress');
            $this->setPrimaryKey('orderAddressId');
        }

    }
    
?>