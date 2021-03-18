<?php
Mage::loadFileByClassName("Block_Core_Template");
    class Block_Payment_Grid extends Block_Core_Template
    {
        protected $payment = [];

        public function __construct()
        {
            $this->setTemplate('./view/payment/grid.php');
        }
        public function setPayment($payment = null)
        {
            if(!$payment)
            {
                $payment = Mage::getModel('Payment');
                $payment = $payment->fetchAll();
                $payment = $payment->getData();
            }
            $this->payment = $payment;
            return $this;
        }
        public function getPayment()
        {
            if(!$this->payment){
                $this->setPayment();
            }
            return $this->payment;
        }
    }
    

?>