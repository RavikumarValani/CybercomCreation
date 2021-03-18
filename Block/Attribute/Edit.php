<?php
    Mage::loadFileByClassName("Block_Core_Template");

    class Block_Attribute_Edit extends Block_Core_Template
    {
        protected $attribute = null;

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/attribute/edit.php');
        }
        
        public function setAttribute($attribute = null)
        {
            if($attribute){
                $this->attribute = $attribute;
                return $this;
            }
            $attribute = Mage::getModel('Attribute');
            $this->setTitle("Add attribute");
            if ($attributeId = (int) $this->getRequest()->getGet('attributeId')) {
                $attribute->load($attributeId);
                $this->setTitle("Update Attribute");
            }
            if(!$attribute){
                $attribute = Mage::getModel('Attribute');
            }
            $this->attribute = $attribute;
            return $this;
        }
        public function getAttribute()
        {
            if(!$this->attribute){
                $this->setAttribute();
            }
            return $this->attribute;
        }
        public function getFormUrl()
        {
            return $this->getUrl()->getUrl('save');
        }
    }
    
?>