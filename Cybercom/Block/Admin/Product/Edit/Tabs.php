<?php 
namespace Block\Admin\Product\Edit;

    \Mage::loadFileByClassName('Block\Core\Edit\Tabs');

    class Tabs extends \Block\Core\Edit\Tabs
    {
        // public function __construct()
        // {
        //     parent::__construct();
        //     $this->setTemplate('./view/core/layout/one-column.php');
        // }
        
        public function prepareTab()
        {
            parent::prepareTab();
            $this->addTab('product',['label' => 'Product information', 'block' => 'Block\Admin\Product\Edit\Tabs\Form']);
            if ($this->getRequest()->getGet('productId')) {
                $this->addTab('category', ['label' => 'Category info', 'block' => 'Block\Admin\Product\Edit\Tabs\Category']);
                $this->addTab('Media', ['label' => 'Media', 'block' => 'Block\Admin\Product\Edit\Tabs\Media']);
                $this->addTab('AttributeOption', ['label' => 'AttributeOption', 'block' => 'Block\Admin\Product\Edit\Tabs\AttributeOption']);
            }
            $this->setDefaultTab('product');
            return $this;
        }

        
    }
    
?>