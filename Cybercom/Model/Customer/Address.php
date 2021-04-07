<?php
namespace Model\Customer;

    \Mage::loadFileByClassName("Model\Core\Table");

    class Address extends \Model\Core\Table
    {
        const TYPE_BILLING = "billing";
        const TYPE_SHIPPING = "shipping";
        
        public function __construct()
        {
            $this->setTableName('customer_address');
            $this->setPrimaryKey('addressId');
        }

        public function getType()
        {
            return [
                self::TYPE_BILLING => 'billing',
                self::TYPE_SHIPPING => 'shipping'
            ];
        }
    }
    
?>