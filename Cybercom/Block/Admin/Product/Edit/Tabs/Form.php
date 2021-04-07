<?php
namespace Block\Admin\Product\Edit\Tabs;

    \Mage::loadFileByClassName('Block\Core\Edit');

    class Form extends  \Block\Core\Edit
    {
        protected $product = null;

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/admin/product/edit/tabs/form.php');
        }

        
        public function getHeading()
        {
            $this->setTitle('Add Product');

            if($productId = (int) $this->getRequest()->getGet('productId'))
            {
                $this->setTitle('Update Product');
            }
            return $this->getTitle();
        }

        // public function setProduct($product = null)
        // {
        //     if($product){
        //         $this->product = $product;
        //         return $this;
        //     }
        //     $product = Mage::getModel('Product');
        //     if ($productId = (int) $this->getRequest()->getGet('productId')) {
        //         $product->load($productId);
        //     }
        //     if(!$product){
        //         $product = new Model_Product();
        //     }
        //     $this->product = $product;
        //     return $this;
        // }
        // public function getProduct()
        // {
        //     if(!$this->product){
        //         $this->setProduct();
        //     }
        //     return $this->product;
        // }
    }
    
?>