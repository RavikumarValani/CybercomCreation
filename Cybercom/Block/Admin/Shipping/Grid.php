<?php
namespace Block\Admin\Shipping;

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
            $shipping = \Mage::getModel('Shipping');
            $query = "SELECT * FROM `{$shipping->getTableName()}` ";

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
            $collection = $shipping->fetchAll($query);
            $this->setCollection($collection);
            return $this;
        }

        public function prepareColumns()
        {
            $this->addColumns('shippingId',[
                'field' => 'shippingId',
                'label' => 'Shipping Id',
                'type' => 'number'
            ]);
            $this->addColumns('name',[
                'field' => 'name',
                'label' => 'Name',
                'type' => 'text'
            ]);
            $this->addColumns('amount',[
                'field' => 'amount',
                'label' => 'Amount',
                'type' => 'decimal'
            ]);
            $this->addColumns('code',[
                'field' => 'code',
                'label' => 'Code',
                'type' => 'number'
            ]);
            return $this;
        }

        public function prepareAction()
        {
            $this->addActions('delete', [
                'label' => 'Delete',
                'method' => 'getDeleteUrl',
                'ajax' => false,
                'class' => 'danger'
            ]);
            return $this;
        }

        public function getDeleteUrl($row)
        {
            return $this->getUrl()->getUrl('delete', null, ['shippingId' => $row->shippingId]);
        }

        public function getTitle()
        {
            return 'Manage Shipping Method';
        }

        public function prepareButton()
        {
            $this->addButton('AddShipping', [
                'label' => 'Add Shipping',
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
    }

?>