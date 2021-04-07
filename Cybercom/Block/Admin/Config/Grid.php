<?php 
namespace Block\Admin\Config;

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
            $config = \Mage::getModel('Config');
            $query = "SELECT * FROM `{$config->getTableName()}` ";

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
            $collection = $config->fetchAll($query);
            $this->setCollection($collection);
            return $this;
        }

        public function prepareColumns()
        {
            $this->addColumns('configId',[
                'field' => 'configId',
                'label' => 'Config Id',
                'type' => 'number'
            ]);
            $this->addColumns('groupId',[
                'field' => 'groupId',
                'label' => 'Group Id',
                'type' => 'number'
            ]);
            $this->addColumns('title',[
                'field' => 'title',
                'label' => 'Title',
                'type' => 'text'
            ]);
            $this->addColumns('code',[
                'field' => 'code',
                'label' => 'Code',
                'type' => 'text'
            ]);
            $this->addColumns('value',[
                'field' => 'value',
                'label' => 'Value',
                'type' => 'text'
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
            $this->addActions('ConfigGroup', [
                'label' => 'Config Group',
                'method' => 'getGroupUrl',
                'ajax' => false,
                'class' => 'primary'
            ]);
            return $this;
        }

        public function getEditurl($row)
        {
            return $this->getUrl()->getUrl('form', null, ['configId' => $row->configId]);
        }

        public function getDeleteUrl($row)
        {
            return $this->getUrl()->getUrl('delete', null, ['configId' => $row->configId]);
        }

        public function getGroupUrl($row)
        {
            return $this->getUrl()->getUrl('grid','Config\Group',['configId' => $row->configId]);
        }

        public function getTitle()
        {
            return 'Manage Config';
        }

        public function prepareButton()
        {
            $this->addButton('AddConfig', [
                'label' => 'Add Config',
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