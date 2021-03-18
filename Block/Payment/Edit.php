<?php
Mage::loadFileByClassName("Block_Core_Template");
    class Block_Payment_Edit extends Block_Core_Template
    {
        protected $payment = null;

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/payment/edit.php');
        }
        
        public function setPayment($payment = null)
        {
            if($payment){
                $this->payment = $payment;
                return $this;
            }
            $payment = Mage::getModel('Payment');
            if ($id = (int) $this->getRequest()->getGet('id')) {
                $payment->load($id);
            }
            if(!$payment){
                $payment = Mage::getModel('Payment');
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
        public function getFormUrl()
        {
            return $this->getUrl()->getUrl('save');
        }
    }
    
?>