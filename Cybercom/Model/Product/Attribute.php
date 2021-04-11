<?php
namespace Model\Product;

    \Mage::loadFileByClassName("Model\Core\Table");
    
    class Attribute extends \Model\Core\Table
    {
        public function __construct()
        {
            $this->setTableName('product_attribute');
            $this->setPrimaryKey('entityId');
        }
    }
    
?>