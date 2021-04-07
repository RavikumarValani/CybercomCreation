<?php
namespace Block\Admin\Customer\Group;

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
            $group = \Mage::getModel('Customer\Group');
            $query = "SELECT * FROM `{$group->getTableName()}` ";

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
            $collection = $group->fetchAll($query);
            $this->setCollection($collection);
            return $this;
        }

        public function prepareColumns()
        {
            $this->addColumns('groupId',[
                'field' => 'groupId',
                'label' => 'Group Id',
                'type' => 'number'
            ]);
            $this->addColumns('name',[
                'field' => 'name',
                'label' => 'Name',
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
            
            return $this;
        }

        public function getEditurl($row)
        {
            return $this->getUrl()->getUrl('form', null, ['groupId' => $row->groupId]);
        }

        public function getDeleteUrl($row)
        {
            return $this->getUrl()->getUrl('delete', null, ['groupId' => $row->groupId]);
        }

        public function getTitle()
        {
            return 'Manage Group';
        }

        public function prepareButton()
        {
            $this->addButton('AddGroup', [
                'label' => 'Add Group',
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