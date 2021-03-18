<?php
    Mage::loadFileByClassName("Block_Core_Template");
    class Block_Customer_Grid extends Block_Core_Template
    {
        protected $customers = [];

        public function __construct()
        {
            $this->setTemplate('./view/customer/grid.php');
        }
        public function setCustomers($customers = null)
        {
            if(!$customers){
                $customers = Mage::getModel('Customer');
                $query = "SELECT c.*,cg.name AS groupName,ca.address
                FROM `customer` AS c 
                JOIN customer_group AS cg
                JOIN `customer_address` AS ca 
                    ON c.groupId = cg.groupId
                    AND ca.addressId = c.addressId";

                $customers = $customers->fetchAll($query);
                
            }
            $this->customers = $customers;
            return $this;
        }
        public function getCustomers()
        {
            if(!$this->customers){
                $this->setCustomers();
            }
            return $this->customers;
        }
    }
    

?>