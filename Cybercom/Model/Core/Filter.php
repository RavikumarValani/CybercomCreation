<?php 
namespace Model\Core;

    \Mage::loadFileByClassName('Model\Admin\Session');

    class Filter extends \Model\Admin\Session
    {

        const TYPE_TEXT = 'text';
        const TYPE_NUMBER = 'number';
        const TYPE_DECIMAL = 'decimal';
        const TYPE_VARCHAR = 'varchar';

        public function getType()
        {
            return [
                self::TYPE_TEXT => 'text',
                self::TYPE_NUMBER => 'number',
                self::TYPE_DECIMAL => 'decimal',
                self::TYPE_VARCHAR => 'varchar'
            ];
        }

        public function setFilters($filters)
        {
            if(!$filters)
            {
                return null;
            }
            
            $filters = array_filter(array_map(function ($value){
                return array_filter($value);
            }, $filters));

            $this->filters = $filters;
            return $this;
        }
        public function getFilters()
        {
            return $this->filters;
        }

        public function hasFilters()
        {
            if(!$this->filters)
            {
                return false;
            }
            return true;
        }

        public function getValue($key, $type)
        {
            if(!$this->filters)
            {
                return null;
            }
            if(!array_key_exists($type, $this->filters))
            {
                return null;
            }
            if(!array_key_exists($key, $this->filters[$type]))
            {
                return null;
            }

            return $this->filters[$type][$key];
        }
    }
?>