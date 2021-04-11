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
                'ajax' => true,
                'class' => 'primary'
            ]);
            $this->addActions('delete', [
                'label' => 'Delete',
                'method' => 'getDeleteUrl',
                'ajax' => true,
                'class' => 'danger'
            ]);
            $this->addActions('groupPrice', [
                'label' => 'Group Price',
                'method' => 'getGroupPriceUrl',
                'ajax' => true,
                'class' => 'primary'
            ]);
            $this->addActions('addCart', [
                'label' => 'AddToCart',
                'method' => 'getAddCartUrl',
                'ajax' => true,
                'class' => 'primary'
            ]);
            return $this;
        }

        public function getEditurl($row)
        {
            $url = $this->getUrl()->getUrl('form', null, ['productId' => $row->productId]);
            return "mage.setUrl('{$url}').resetParams().load()";
        }

        public function getDeleteUrl($row)
        {
            $url = $this->getUrl()->getUrl('delete', null, ['productId' => $row->productId]);
            return "mage.setUrl('{$url}').resetParams().load()";
        }

        public function getGroupPriceUrl($row)
        {
            $url = $this->getUrl()->getUrl('index', 'Product\Group\Price', ['productId' => $row->productId]);
            return "mage.setUrl('{$url}').resetParams().load()";
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
                'ajax' => true
            ]);
            $this->addButton('Filter', [
                'label' => 'Apply Filter',
                'method' => 'getFilterUrl',
                'ajax' => true
            ]);
            return $this;
        }

        public function getAddUrl()
        {
            $url = $this->getUrl()->getUrl('form');
            return "mage.setUrl('{$url}').load()";
        }

        public function getFilterUrl()
        {
            $url = $this->getUrl()->getUrl('filter');
            return "mage.setUrl('{$url}').load()";
        }

        public function getAddCartUrl($row)
        {
            $url = $this->getUrl()->getUrl('addToCart', 'Cart', ['productId' => $row->productId]);
            return "mage.setUrl('{$url}').resetParams().load()";
        }
    }

?>