<?php
namespace Block\Admin\Config\Group\Edit\Tabs;

    \Mage::loadFileByClassName('Block\Core\Edit');

    class Form extends  \Block\Core\Edit
    {

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/admin/config/group/edit/tabs/form.php');
        }

        
        public function getHeading()
        {
            $this->setTitle('Add Config Group');

            if((int) $this->getRequest()->getGet('configId'))
            {
                $this->setTitle('Update Config');
            }
            return $this->getTitle();
        }
    }
?>