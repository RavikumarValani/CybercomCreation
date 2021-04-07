<?php
namespace Block\Admin\Category\Edit\Tabs;

    \Mage::loadFileByClassName('Block\Core\Edit\Tabs');

    class Media extends  \Block\Core\Edit\Tabs
    {
        public function __construct()
        {
            $this->setTemplate('./view/admin/category/edit/tabs/media.php');
        }
    }
    
?>