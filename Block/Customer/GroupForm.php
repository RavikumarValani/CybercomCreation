<?php
    Mage::loadFileByClassName('Block_Core_Template');

    class Block_Customer_GroupForm extends Block_Core_Template
    {
        protected $customer = null;

        public function __construct()
        {
            $this->setTemplate('./view/customer/group-form.php');
        }

        public function setCustomers($customer = null)
        {
            if($customer){
                $this->customer = $customer;
                return $this;
            }
            $customer = Mage::getModel('CustomerGroup');
            // if ($id = (int) $this->getRequest()->getGet('group_id')) 
            // {
            //     $customer->load($id);
            // }
            if(!$customer){
                $customer = Mage::getModel('CustomerGroup');
            }
            $this->customer = $customer;
            return $this;
        }
        public function getCustomers()
        {
            if (!$this->customer) 
            {
                $this->setCustomers();
            }
            return $this->customer;
        }
    }
    
?>