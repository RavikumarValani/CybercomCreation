<?php
namespace Block\Admin\Shipping\Edit\Tabs;

    \Mage::loadFileByClassName('Block\Core\Edit');

    class Form extends  \Block\Core\Edit
    {
        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/admin/shipping/edit/tabs/form.php');
        }

        public function getTitle()
        {
            return 'Add Shipping Method';
        }

        public function getShipping()
        {
            return \Mage::getModel('Shipping');
        }
    }
    
?>