<?php
    Mage::loadFileByClassName("Block_Core_Template");
    class Block_Admin_Edit extends Block_Core_Template 
    {
        protected $admin = null;

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/admin/edit.php');
        }
        public function setAdmin($admin = null)
        {
            if($admin){
                $this->admin = $admin;
                return $this;
            }
            $admin = Mage::getModel('Admin');
            $this->setTitle("Add Admin");
            if ($id = (int) $this->getRequest()->getGet('id')) {
                $admin->load($id);
                $this->setTitle("Update admin");
            }
            if(!$admin){
                $admin = Mage::getModel('Admin');
            }
            $this->admin = $admin;
            return $this;
        }
        public function getAdmin()
        {
            if(!$this->admin){
                $this->setAdmin();
            }
            return $this->admin;
        }

    }
    
?>