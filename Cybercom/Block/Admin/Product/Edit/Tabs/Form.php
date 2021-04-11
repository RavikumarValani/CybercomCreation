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

            if((int) $this->getRequest()->getGet('productId'))
            {
                $this->setTitle('Update Product');
            }
            return $this->getTitle();
        }

        
    }
    
?>