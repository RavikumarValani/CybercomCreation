<?php
namespace Block\Admin\Admin\Edit\Tabs;

    \Mage::loadFileByClassName('Block\Core\Edit');

    class Form extends  \Block\Core\Edit
    {
        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/admin/admin/edit/tabs/form.php');
        }

        public function getTitle()
        {
            return 'Add Admin';
        }

        public function getAdmin()
        {
            return \Mage::getModel('Admin');
        }
    }
    
?>