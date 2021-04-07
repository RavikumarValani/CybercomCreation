<?php
namespace Model\Cart;

    \Mage::loadFileByClassName("Model\Core\Table");

    class Address extends \Model\Core\Table
    {
        const TYPE_BILLING = "billing";
        const TYPE_SHIPPING = "shipping";
        
        protected $cart = null;
        protected $customerBillingAddress = null;
        protected $customerShippingAddress = null;

        public function __construct()
        {
            $this->setTableName('cart_address');
            $this->setPrimaryKey('cartAddressId');
        }

        public function setCart(\Model\Cart $cart)
        {
            $this->cart = $cart;
            return $this;
        }
        public function getCart()
        {
            if(!$this->cartId)
            {
                return false;
            }

            $cart = \Mage::getModel('Cart')->load($this->cartId);
            $this->setCart($cart);
            return $this->cart;
        }

        public function setCustomerBillingAddress(\Model\Customer\Address $customerBillingAddress)
        {
            $this->customerBillingAddress = $customerBillingAddress;
            return $this;
        }
        public function getCustomerBillingAddress()
        {
            if(!$this->customerId)
            {
                return $this;
            }

            $address = \Mage::getModel('Customer\Address');
            $query = "SELECT * FROM `{$address->getTableName()}` WHERE `customerId` = '{$this->customerId}' AND `type` = '{\Model\Customer\Address::TYPE_BILLING}' ";
            $customerBillingAddress = $address->fetchRow($query);
            $this->setCustomerBillingAddress($customerBillingAddress);
            return $this->customerBillingAddress;
        }

        public function setCustomerShippingAddress(\Model\Customer\Address $customerShippingAddress)
        {
            $this->customerShippingAddress = $customerShippingAddress;
            return $this;
        }
        public function getCustomerShippingAddress()
        {
            if(!$this->cartId)
            {
                return $this;
            }

            $address = \Mage::getModel('Customer\Address');
            $query = "SELECT * FROM `{$address->getTableName()}` WHERE `cartId` = '{$this->cartId}' AND `type` = '{\Model\Customer\Address::TYPE_SHIPPING}' ";
            $customerShippingAddress = $address->fetchRow($query);
            $this->setCustomerShippingAddress($customerShippingAddress);
            return $this->customerShippingAddress;
        }
    }
    
?>