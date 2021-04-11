<?php
namespace Block\Admin\Attribute;

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
            $attribute = \Mage::getModel('attribute');
            $query = "SELECT * FROM `{$attribute->getTableName()}` ";

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
            $collection = $attribute->fetchAll($query);
            $this->setCollection($collection);
            return $this;
        }

        public function prepareColumns()
        {
            $this->addColumns('attributeId',[
                'field' => 'attributeId',
                'label' => 'Attribute Id',
                'type' => 'number'
            ]);
            $this->addColumns('entityTypeId',[
                'field' => 'entityTypeId',
                'label' => 'EntityTypeId',
                'type' => 'text'
            ]);
            $this->addColumns('name',[
                'field' => 'name',
                'label' => 'Attribute Name',
                'type' => 'text'
            ]);
            $this->addColumns('code',[
                'field' => 'code',
                'label' => 'Code',
                'type' => 'number'
            ]);
            $this->addColumns('inputType',[
                'field' => 'inputType',
                'label' => 'Input Type',
                'type' => 'varchar'
            ]);
            $this->addColumns('backEndType',[
                'field' => 'backEndType',
                'label' => 'BackEnd Type',
                'type' => 'varchar'
            ]);
            $this->addColumns('sortOrder',[
                'field' => 'sortOrder',
                'label' => 'SortOrder',
                'type' => 'number'
            ]);
            $this->addColumns('backEndModel',[
                'field' => 'backEndModel',
                'label' => 'BackEnd Model',
                'type' => 'varchar'
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
            $this->addActions('Option', [
                'label' => 'Option',
                'method' => 'getOptionUrl',
                'ajax' => true,
                'class' => 'primary'
            ]);
            return $this;
        }

        public function getEditurl($row)
        {
            $url = $this->getUrl()->getUrl('form', null, ['attributeId' => $row->attributeId]);
            return "mage.setUrl('{$url}').resetParams().load()";
        }

        public function getDeleteUrl($row)
        {
            $url = $this->getUrl()->getUrl('delete', null, ['attributeId' => $row->attributeId]);
            return "mage.setUrl('{$url}').resetParams().load()";
        }

        public function getOptionUrl($row)
        {
            $url = $this->getUrl()->getUrl('grid','Attribute\Option',['attributeId' => $row->attributeId]);
            return "mage.setUrl('{$url}').resetParams().load()";
        }

        public function getTitle()
        {
            return 'Manage Attribute';
        }

        public function prepareButton()
        {
            $this->addButton('AddAttribute', [
                'label' => 'Add Attribute',
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
            $url = $this->getUrl()->getUrl("form"); 
            return "mage.setUrl('{$url}').load()";
        }

        public function getFilterUrl()
        {
            $url = $this->getUrl()->getUrl('filter');
            return "mage.setUrl('{$url}').load()";
        }
    }

?>