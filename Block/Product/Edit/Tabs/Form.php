<?php
    Mage::loadFileByClassName('Block_Core_Template');
    class Block_Product_Edit_Tabs_Form extends  Block_Core_Template
    {
        protected $product = null;

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/product/edit/tabs/form.php');
        }

        public function setProduct($product = null)
        {
            if($product){
                $this->product = $product;
                return $this;
            }
            $product = Mage::getModel('Product');
            if ($id = (int) $this->getRequest()->getGet('id')) {
                $product->load($id);
            }
            if(!$product){
                $product = new Model_Product();
            }
            $this->product = $product;
            return $this;
        }
        public function getProduct()
        {
            if(!$this->product){
                $this->setProduct();
            }
            return $this->product;
        }
    }
    
?>