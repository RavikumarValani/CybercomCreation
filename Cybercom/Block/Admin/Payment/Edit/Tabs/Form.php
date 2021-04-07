<?php
namespace Block\Admin\Payment\Edit\Tabs;

    \Mage::loadFileByClassName('Block\Core\Edit');

    class Form extends  \Block\Core\Edit
    {
        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/admin/payment/edit/tabs/form.php');
        }

        public function getTitle()
        {
            return 'Add Payment Method';
        }

        public function getPayment()
        {
            return \Mage::getModel('Payment');
        }
    }
    
?>