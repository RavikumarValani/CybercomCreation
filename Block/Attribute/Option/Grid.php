<?php

    Mage::loadFileByClassName('Block_Core_Template');

    class Block_Attribute_Option_Grid extends Block_Core_Template
    {
        protected $attribute = [];

        public function __construct() {
            $this->setTemplate('./view/attribute/option/grid.php');
        }

        public function setAttribute(Model_Attribute $attribute)
        {
            $this->attribute = $attribute;
            return $this;
        }
        public function getAttribute()
        {
            return $this->attribute;
        }
    }
    
?>