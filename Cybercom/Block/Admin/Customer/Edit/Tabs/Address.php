<?php
namespace Block\Admin\Customer\Edit\Tabs;

use Mage;

\mage::loadFileByClassName('Block\Core\Edit\Tabs');

    class Address extends  \Block\Core\Edit\Tabs
    {
        protected $billingAddress = [];
        protected $shippingAddress = [];

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/admin/customer/edit/tabs/address.php');
        }

        public function setBillingAddress($billingAddress = null)
        {
            if($billingAddress){
                $this->billingAddress = $billingAddress;
                return $this;
            }
            $address = \Mage::getModel('Customer\Address');
            if ($customerId = (int) $this->getRequest()->getGet('customerId')) {
                $condition = "AND `type` = 'billing'";
                $billingAddress = $address->load($customerId,'customerId', $condition);
            }
            if(!$billingAddress){
                $billingAddress = \Mage::getModel('Customer\Address');
            }
            $this->billingAddress = $billingAddress;
            return $this;
        }
        public function getBillingAddress()
        {
            if(!$this->billingAddress){
                $this->setBillingAddress();
            }
            return $this->billingAddress;
        }

        public function setShippingAddress($shippingAddress = null)
        {
            if($shippingAddress){
                $this->shippingAddress = $shippingAddress;
                return $this;
            }
            $address = \Mage::getModel('Customer\Address');
            if ($customerId = (int) $this->getRequest()->getGet('customerId')) {
                $condition = "AND `type` = 'shipping'";
                $shippingAddress = $address->load($customerId,'customerId', $condition);
            }
            if(!$shippingAddress){
                $shippingAddress = \Mage::getModel('Customer\Address');
            }
            $this->shippingAddress = $shippingAddress;
            return $this;
        }
        public function getShippingAddress()
        {
            if(!$this->shippingAddress){
                $this->setShippingAddress();
            }
            return $this->shippingAddress;
        }
    }
    
?>