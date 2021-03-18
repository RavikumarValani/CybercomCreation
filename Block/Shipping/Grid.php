<?php
    Mage::loadFileByClassName("Block_Core_Template");

    class Block_Shipping_Grid extends Block_Core_Template 
    {
        protected $shipping = [];

        public function __construct()
        {
            $this->setTemplate('./view/shipping/grid.php');
        }
        public function setShipping($shipping = null)
        {
            if(!$shipping){
                $shipping = Mage::getModel('Shipping');
                $shipping = $shipping->fetchAll();
                $shipping = $shipping->getData();
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
    }
    

?>