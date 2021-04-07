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

        public function setAttributeOptions($attributeOptions = null)
        {
            if(!$attributeOptions)
            {
                $attribute = \Mage::getModel('Attribute');
                $query = "SELECT * FROM `attribute`
                WHERE `entityTypeId` = 'product' ";
                $attributeData = $attribute->fetchAll($query);
                if(!$attributeData)
                {
                    return null;
                }
                $attributeData = $attributeData->getData();
                $attributeOption = \Mage::getModel('Attribute\Option');
                foreach ($attributeData as $key => $attribute) {
                    $attributeId = $attribute->getOriginalData()['attributeId'];
                    $query = "SELECT * FROM `attribute_option`
                    WHERE `attributeId` = '{$attributeId}' ";
                    if(!$attributeOption->fetchAll($query))
                    {
                        continue;
                    }
                    $attributeOptions = $attributeOption->fetchAll($query);
                }
            }
            $this->attributeOptions = $attributeOptions;
            return $this;
        }
        public function getAttributeOptions()
        {
            if(!$this->attributeOptions)
            {
                $this->setAttributeOptions();
            }
            return $this->attributeOptions;
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