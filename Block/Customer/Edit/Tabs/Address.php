<?php
    mage::loadFileByClassName('Block_Core_Template');

    class Block_Customer_Edit_Tabs_Address extends  Block_Core_Template
    {
        protected $address = null;
        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/customer/edit/tabs/address.php');
        }

        public function setAddress($address = null)
        {
            if($address){
                $this->address = $address;
                return $this;
            }
            $address = Mage::getModel('Customer');
            if ($id = (int) $this->getRequest()->getGet('id')) {
                $address->load($id);
            }
            if(!$address){
                $address = new Model_Customer();
            }
            $this->address = $address;
            return $this;
        }
        public function getAddress()
        {
            if(!$this->address){
                $this->setAddress();
            }
            return $this->address;
        }
    }
    
?>