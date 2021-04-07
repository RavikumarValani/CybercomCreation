<?php
namespace Block\Admin\Payment;

    \Mage::loadFileByClassName("Block\Core\Edit");

    class Edit extends \Block\Core\Edit
    {
        protected $payment = null;

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/admin/payment/edit.php');
        }
        
        public function setPayment($payment = null)
        {
            if($payment){
                $this->payment = $payment;
                return $this;
            }
            $payment = \Mage::getModel('Payment');
            if ($id = (int) $this->getRequest()->getGet('id')) {
                $payment->load($id);
            }
            if(!$payment){
                $payment = \Mage::getModel('Payment');
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