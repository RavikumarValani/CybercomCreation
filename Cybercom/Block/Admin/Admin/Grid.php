<?php
namespace Block\Admin\Admin;

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
            $admin = \Mage::getModel('admin');
            $query = "SELECT * FROM `{$admin->getTableName()}` ";

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
            $collection = $admin->fetchAll($query);
            $this->setCollection($collection);
            return $this;
        }

        public function prepareColumns()
        {
            $this->addColumns('adminId',[
                'field' => 'adminId',
                'label' => 'Admin Id',
                'type' => 'number'
            ]);
            $this->addColumns('username',[
                'field' => 'username',
                'label' => 'Username',
                'type' => 'number'
            ]);
            $this->addColumns('password',[
                'field' => 'password',
                'label' => 'Password',
                'type' => 'text'
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
            return $this->getUrl()->getUrl('delete', null, ['productId' => $row->productId]);
        }

        public function getTitle()
        {
            return 'Manage Admin';
        }

        public function prepareButton()
        {
            $this->addButton('AddAdmin', [
                'label' => 'Add Admin',
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