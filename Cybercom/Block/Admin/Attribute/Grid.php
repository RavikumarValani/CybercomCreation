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
                'ajax' => false,
                'class' => 'primary'
            ]);
            $this->addActions('delete', [
                'label' => 'Delete',
                'method' => 'getDeleteUrl',
                'ajax' => false,
                'class' => 'danger'
            ]);
            $this->addActions('Option', [
                'label' => 'Option',
                'method' => 'getOptionUrl',
                'ajax' => false,
                'class' => 'primary'
            ]);
            return $this;
        }

        public function getEditurl($row)
        {
            return $this->getUrl()->getUrl('form', null, ['attributeId' => $row->attributeId]);
        }

        public function getDeleteUrl($row)
        {
            return $this->getUrl()->getUrl('delete', null, ['attributeId' => $row->attributeId]);
        }

        public function getOptionUrl($row)
        {
            return $this->getUrl()->getUrl('options',null,['attributeId' => $row->attributeId]);
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
                'ajax' => false
            ]);
            return $this;
        }

        public function getAddUrl()
        {
            return 'mage.setUrl("<?php echo $this->getUrl()->getUrl("form"); ?>").load();" href="javascript:void(0);"';
        }

        public function getFilterUrl()
        {
            return $this->getUrl()->getUrl('filter');
        }
    }

?>