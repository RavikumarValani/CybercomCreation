<?php
namespace Block\Admin\Customer\Edit\Tabs;

    \Mage::loadFileByClassName('Block\Core\Edit');

    class Form extends  \Block\Core\Edit
    {
        protected $customer = null;

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/admin/customer/edit/tabs/form.php');
        }

        public function getHeading()
        {
            $this->setTitle('Add Detail');

            if($id = (int) $this->getRequest()->getGet('id'))
            {
                $this->setTitle('Update Detail');
            }
            return $this->getTitle();
        }
        
        public function getCustomergroup()
        {
            return \Mage::getModel('Customer\Group')->fetchAll();
        }
    }
    
?>