<?php
namespace Block\Admin\Product\Edit\Tabs;

    \Mage::loadFileByClassName('Block\Core\Edit\Tabs');

    class AttributeOption extends  \Block\Core\Edit\Tabs
    {
        protected $attributeOptions = [];

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/admin/product/edit/tabs/attribute-option.php');
        }


        public function getAttributes()
        {
            $attribute = \Mage::getModel('Attribute');
            $query = "SELECT * FROM `attribute`
            WHERE `entityTypeId` = 'product' ";
            return $attribute->fetchAll($query);
        }

    }
    
?>