<?php
namespace Block\Admin\Product\Edit\Tabs;

    \Mage::loadFileByClassName('Block\Core\Edit\Tabs');

    class Category extends  \Block\Core\Edit\Tabs
    {
        public function __construct()
        {
            $this->setTemplate('./view/admin/product/edit/tabs/category.php');
        }
    }
    
?>