<?php
    Mage::loadFileByClassName("Block_Core_Template");
    class Block_Admin_Grid extends Block_Core_Template  
    {
        protected $admin = [];
        
        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/admin/grid.php');
        }
        public function setAdmins($admin = null)
        {
            if(!$admin){
                $admin = Mage::getModel('Admin');
                $admin = $admin->fetchAll();
            }
            $this->admin = $admin;
            return $this;
        }
        public function getAdmins()
        {
            if (!$this->admin) {
                $this->setAdmins();
            }
            return $this->admin;
        }

    }
    

?>