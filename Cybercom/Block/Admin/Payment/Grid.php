<?php
namespace Block\Admin\Payment;

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
            $payment = \Mage::getModel('Payment');
            $query = "SELECT * FROM `{$payment->getTableName()}` ";

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
            $collection = $payment->fetchAll($query);
            $this->setCollection($collection);
            return $this;
        }

        public function prepareColumns()
        {
            $this->addColumns('paymentId',[
                'field' => 'paymentId',
                'label' => 'Payment Id',
                'type' => 'number'
            ]);
            $this->addColumns('name',[
                'field' => 'name',
                'label' => 'Name',
                'type' => 'text'
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
                'ajax' => true,
                'class' => 'danger'
            ]);
            return $this;
        }

        public function getDeleteUrl($row)
        {
            $url = $this->getUrl()->getUrl('delete', null, ['paymentId' => $row->paymentId]);
            return "mage.setUrl('{$url}').resetParams().load()";
        }

        public function getTitle()
        {
            return 'Manage Payment Method';
        }

        public function prepareButton()
        {
            $this->addButton('AddPayment', [
                'label' => 'Add Payment',
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
            return "mage.setUrl('{$url}').resetParams().load()";
        }

        public function getFilterUrl()
        {
            $url = $this->getUrl()->getUrl('filter');
            return "mage.setUrl('{$url}').resetParams().load()";
        }
    }

?>