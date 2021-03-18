<?php
    Mage::loadFileByClassName("Block_Core_Template");

    class Block_Shipping_Edit extends Block_Core_Template
    {
        protected $shipping = null;

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/shipping/edit.php');
        }
        
        public function setShipping($shipping = null)
        {
            if($shipping){
                $this->shipping = $shipping;
                return $this;
            }
            $shipping = Mage::getModel('Shipping');
            $this->setTitle("Add Shipping");
            if ($id = (int) $this->getRequest()->getGet('id')) {
                $shipping->load($id);
                $this->setTitle("Update Shipping");
            }
            if(!$shipping){
                $shipping = new Model_Shipping();
            }
            $this->shipping = $shipping;
            return $this;
        }
        public function getShipping()
        {
            if(!$this->shipping){
                $this->setShipping();
            }
            return $this->shipping;
        }
        public function getFormUrl()
        {
            return $this->getUrl()->getUrl('save');
        }
    }
    
?>