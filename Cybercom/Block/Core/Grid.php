<?php
namespace Block\Core;

    \Mage::loadFileByClassName('Block\Core\Template');

    class Grid extends \Block\Core\Template 
    {
        protected $collection = [];
        protected $columns = [];
        protected $actions = [];
        protected $buttons = [];
        protected $filter = null;

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/core/grid.php');
            $this->prepareColumns();
            $this->prepareAction();
            $this->prepareButton();
        }

        public function setCollection($collection)
        {
            $this->collection = $collection;
            return $this;
        }
        public function getCollection()
        {
            if(!$this->collection){
                $this->prepareCollection();
            }
            return $this->collection;
        }

        public function prepareCollection()
        {
            return $this;
        }

        public function addColumns($key, $value)
        {
            $this->columns[$key] = $value;
            return $this;
        }
        public function getColumns()
        {
            return $this->columns;
        }

        public function prepareColumns()
        {
            return $this;
        }

        public function getFieldValue($row, $field)
        {
            return $row->$field;
        }

        public function addActions($key, $value)
        {
            $this->actions[$key] = $value;
            return $this;
        }
        public function getActions()
        {
            return $this->actions;
        }

        public function prepareAction()
        {
            return $this;
        }

        public function getMethodUrl($row, $methodName)
        {
            return $this->$methodName($row);
        }

        public function getTitle()
        {
            return 'Set Title';
        }

        public function addButton($key, $value)
        {
            $this->buttons[$key] = $value;
            return $this;
        }
        public function getButtons()
        {
            return $this->buttons;
        }

        public function prepareButton()
        {
            return $this;
        }

        public function getButtonUrl($methodName)
        {
            return $this->$methodName();
        }

        public function setFilter($filter = null)
        {
            if(!$filter)
            {
                $filter = \Mage::getModel('Core\Filter');
            }
            $this->filter = $filter;
            return $this;
        }
        public function getFilter()
        {
            if(!$this->filter)
            {
                $this->setFilter();
            }
            return $this->filter;
        }

        
    }

?>