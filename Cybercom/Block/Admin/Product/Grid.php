<?php
namespace Block\Admin\Product;

    \Mage::loadFileByClassName('Block\Core\Grid');

    class Grid extends \Block\Core\Grid 
    {
        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/core/grid.php');
        }   

        public function prepareCollection()
        {
            $product = \Mage::getModel('Product');
            $query = "SELECT * FROM `{$product->getTableName()}` ";

            if($this->getFilter()->hasFilters())
            {
                $query .= " WHERE 1=1";
                foreach($this->getFilter()->getFilters() as $type => $filters)
                {
                    if($type == $this->getFilter()->getType()[$type])
                    {
                        foreach($filters as $key => $value)
                        {
                            $query .= " AND `{$key}` LIKE '%{$value}%'";
                        }
                    }
                }
            }
            $collection = $product->fetchAll($query);
            $this->setCollection($collection);
            return $this;
        }

        public function prepareColumns()
        {
            $this->addColumns('productId',[
                'field' => 'productId',
                'label' => 'Product Id',
                'type' => 'number'
            ]);
            $this->addColumns('sku',[
                'field' => 'sku',
                'label' => 'SKU',
                'type' => 'number'
            ]);
            $this->addColumns('name',[
                'field' => 'name',
                'label' => 'Product Name',
                'type' => 'text'
            ]);
            $this->addColumns('price',[
                'field' => 'price',
                'label' => 'Product Price',
                'type' => 'decimal'
            ]);
            $this->addColumns('discount',[
                'field' => 'discount',
                'label' => 'Discount',
                'type' => 'decimal'
            ]);
            $this->addColumns('quantity',[
                'field' => 'quantity',
                'label' => 'Quantity',
                'type' => 'number'
            ]);
            return $this;
        }

        public function prepareAction()
        {
            $this->addActions('edit', [
                'label' => 'Edit',
                'method' => 'getEditUrl',
                'ajax' => false,
                'class' => 'primary'
            ]);
            $this->addActions('delete', [
                'label' => 'Delete',
                'method' => 'getDeleteUrl',
                'ajax' => false,
                'class' => 'danger'
            ]);
            $this->addActions('groupPrice', [
                'label' => 'Group Price',
                'method' => 'getGroupPriceUrl',
                'ajax' => false,
                'class' => 'primary'
            ]);
            $this->addActions('addCart', [
                'label' => 'AddToCart',
                'method' => 'getAddCartUrl',
                'ajax' => false,
                'class' => 'primary'
            ]);
            return $this;
        }

        public function getEditurl($row)
        {
            return $this->getUrl()->getUrl('form', null, ['productId' => $row->productId]);
        }

        public function getDeleteUrl($row)
        {
            return $this->getUrl()->getUrl('delete', null, ['productId' => $row->productId]);
        }

        public function getGroupPriceUrl($row)
        {
            return $this->getUrl()->getUrl('index', 'Product\Group\Price', ['productId' => $row->productId]);
        }

        public function getTitle()
        {
            return 'Manage Product';
        }

        public function prepareButton()
        {
            $this->addButton('AddProduct', [
                'label' => 'Add Product',
                'method' => 'getAddUrl',
                'ajax' => false
            ]);
            $this->addButton('Filter', [
                'label' => 'Apply Filter',
                'method' => 'getFilterUrl',
                'ajax' => false
            ]);
            return $this;
        }

        public function getAddUrl()
        {
            return $this->getUrl()->getUrl('form');
        }

        public function getFilterUrl()
        {
            return $this->getUrl()->getUrl('filter');
        }

        public function getAddCartUrl($row)
        {
            return $this->getUrl()->getUrl('addToCart', 'Cart', ['productId' => $row->productId]);
        }
    }

?>