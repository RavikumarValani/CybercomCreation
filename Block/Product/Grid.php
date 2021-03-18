<?php
    Mage::loadFileByClassName("Block_Core_Template");
    class Block_Product_Grid extends Block_Core_Template 
    {
        protected $products = [];

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/product/grid.php');
        }
        public function setProducts($products = null)
        {
            if(!$products){
                $products = Mage::getModel('Product');
                $products = $products->fetchAll();
            }
            $this->products = $products;
            return $this;
        }
        public function getProducts()
        {
            if(!$this->products){
                $this->setProducts();
            }
            return $this->products;
        }
    }
    

?>