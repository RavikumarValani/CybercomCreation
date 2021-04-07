<?php
namespace Block\Admin\Attribute\Edit\Tabs;

    \Mage::loadFileByClassName('Block\Core\Edit');

    class Form extends  \Block\Core\Edit
    {
        protected $customer = null;

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/admin/Attribute/edit/tabs/form.php');
        }

        public function getHeading()
        {
            $this->setTitle('Add Attribute');

            if((int) $this->getRequest()->getGet('attributeId'))
            {
                $this->setTitle('Update Attribute');
            }
            return $this->getTitle();
        }
    }
    
?>