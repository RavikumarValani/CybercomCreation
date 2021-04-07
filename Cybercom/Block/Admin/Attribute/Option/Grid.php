<?php
namespace Block\Admin\Attribute\Option;

    \Mage::loadFileByClassName('Block\Core\Template');

    class Grid extends \Block\Core\Template
    {
        protected $attribute = [];

        public function __construct() {
            $this->setTemplate('./view/admin/attribute/option/grid.php');
        }

        public function setAttribute(\Model\Attribute $attribute)
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