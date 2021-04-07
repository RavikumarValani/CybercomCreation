<?php
namespace Model;

    \Mage::loadFileByClassName("Model\Core\Table");

    class Customer extends \Model\Core\Table
    {
        const STATUS_ENABLE = 1;
        const STATUS_DISABLE = 0;

        protected $billingAddress = null;
        protected $shippingAddress = null;

        public function __construct()
        {
            $this->setTableName('customer');
            $this->setPrimaryKey('customerId');
        }
        
        public function getStatusOption()
        {
            return [
                self::STATUS_ENABLE => "Enable",
                self::STATUS_DISABLE => "Disable"
            ];
        }

        public function setBillingAddress(\Model\Customer\Address $billingAddress)
        {
            $this->billingAddress = $billingAddress;
            return $this;
        }
        public function getBillingAddress()
        {
            if(!$this->customerId)
            {
                return $this;
            }

            $address = \Mage::getModel('Customer\Address');
            $type = \Model\Customer\Address::TYPE_BILLING;
            $query = "SELECT * FROM `{$address->getTableName()}` WHERE `customerId` = '{$this->customerId}' AND `type` = '{$type}' ";
            $billingAddress = $address->fetchRow($query);
            if(!$billingAddress)
            {
                return null;
            }
            $this->setBillingAddress($billingAddress);
            return $this->billingAddress;
        }

        public function setShippingAddress(\Model\Customer\Address $shippingAddress)
        {
            $this->shippingAddress = $shippingAddress;
            return $this;
        }
        public function getShippingAddress()
        {
            if(!$this->customerId)
            {
                return $this;
            }

            $address = \Mage::getModel('Customer\Address');
            $type = \Model\Customer\Address::TYPE_SHIPPING;
            $query = "SELECT * FROM `{$address->getTableName()}` WHERE `customerId` = '{$this->customerId}' AND `type` = '{$type}' ";
            $shippingAddress = $address->fetchRow($query);
            if(!$shippingAddress)
            {
                return null;
            }
            $this->setShippingAddress($shippingAddress);
            return $this->shippingAddress;
        }

    }
    
?>