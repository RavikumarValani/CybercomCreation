<?php
    Mage::loadFileByClassName('Block_Core_Template');
    class Block_Customer_Edit_Tabs_Form extends  Block_Core_Template
    {
        protected $customer = null;

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/customer/edit/tabs/form.php');
        }

        public function setCustomer($customer = null)
        {
            if($customer){
                $this->customer = $customer;
                return $this;
            }
            $customer = Mage::getModel('Customer');
            if ($id = (int) $this->getRequest()->getGet('id')) {
                $customer->load($id);
            }
            if(!$customer){
                $customer = new Model_Customer();
            }
            $this->customer = $customer;
            return $this;
        }
        public function getCustomer()
        {
            if(!$this->customer){
                $this->setCustomer();
            }
            return $this->customer;
        }

        public function getCustomergroup()
        {
            return Mage::getModel('CustomerGroup')->fetchAll();
        }
    }
    
?>