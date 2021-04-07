<?php 
namespace Model\Core;

    class Table 
    {
        protected $adapter = null;

        protected $primaryKey = null;
        protected $tableName = null;
        protected $originalData = [];
        protected $data = [];

        public function setAdapter($adapter = null)
        {
            if (!$adapter) 
            {
                $adapter = \Mage::getModel('Core\Adapter');
            }
            $this->adapter = $adapter;
            return $this;
        }
        public function getAdapter()
        {
            if(!$this->adapter)
            {
                $this->setAdapter();
            }
            return $this->adapter;
        }

        public function setPrimaryKey($primaryKey)
        {
            $this->primaryKey = $primaryKey;
            return $this;
        }
        public function getPrimaryKey()
        {
            return $this->primaryKey;
        }

        public function setTableName($tableName)
        {
            $this->tableName = $tableName;
            return $this;
        }
        public function getTableName()
        {
            return $this->tableName;
        }
        
        public function setData(array $data)
        {
            $this->data = array_merge($this->data,$data);
            return $this; 
        }
        public function getData()
        {
            return $this->data; 
        }

        public function setOriginalData(array $originalData)
        {
            $this->originalData = $originalData;
            return $this; 
        }
        public function getOriginalData()
        {
            return $this->originalData; 
        }

        public function __set($key,$value)
        {
            $this->data[$key] = $value;
            return $this;
        }
        public function __get($key)
        {
            if(array_key_exists($key,$this->data))
            {
                return $this->data[$key];
            }
            if(array_key_exists($key,$this->originalData))
            {
                return $this->originalData[$key];
            }
            
        }

        public function resetData()
        {
            $this->data = [];
            return $this;
        }

        public function save()
        {
            if(array_key_exists($this->getPrimaryKey(), $this->data))
            {
                unset($this->data[$this->getPrimaryKey()]);
            }
            $id = (int) $this->{$this->getPrimaryKey()};
            if(!$this->data)
            {
                return false;
            }
            if(!$id)
            {
                $query = "INSERT INTO `{$this->getTableName()}` (`".implode('`,`',array_keys($this->data))."`) VALUES ('".implode('\',\'',array_values($this->data))."' )";
                
                $id = $this->getAdapter()->insert($query); 
            
                $this->load($id);

                return $this;
            }
            else
            {
                
                $params = null;

                foreach ($this->data as $key => $value) {
                    $params[] = "$key = '$value'";
                }
                $query = "UPDATE `{$this->getTableName()}` SET ". implode(', ', $params)." WHERE {$this->getPrimaryKey()}={$id}";
                
                $this->getAdapter()->update($query);

                return true;
            }
        }

        public function delete($id = null)
        {
            if($id == null)
            {
                if(!array_key_exists($this->primaryKey,$this->data))
                {
                    return false;
                }
                $id = $this->primaryKey;
            }

            $query = "DELETE FROM `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}` = {$id}";
            $this->getAdapter()->delete($query);
            return true;

        }

        public function load($value, $optional = null, $condition = null)
        {
            $id =(int) $value;
            if($optional)
            {
                $query = "SELECT * FROM `{$this->getTableName()}` WHERE `{$optional}` = {$id} {$condition}";
            }
            else
            {
                $query = "SELECT * FROM `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}` = {$id}";
            }
            return $this->fetchRow($query);
        }

        public function fetchRow($query)
        {
            $data = $this->getAdapter()->fetchRow($query);
            if (!$data) 
            {
                return false;
            }
            $this->setOriginalData($data);
            $this->resetData();
            return $this;
        }

        public function fetchAll($query = null)
        {
            if (!$query) 
            {
                $query = "SELECT * FROM `{$this->getTableName()}`";    
            }
            $rows = $this->getAdapter()->fetchAll($query);
            if (!$rows) 
            {
                return false;
            }
            foreach ($rows as $key => $value) 
            {
                $row = new $this;
                $value = $row->setOriginalData($value);
                $rowsArray[] = $row;
            }
            
            $collectionClassName = get_class($this)."\\Collection";
            $collectionClassName = str_replace("Model\\",'',$collectionClassName);
            $collection = \Mage::getModel($collectionClassName);
            $collection->setData($rowsArray);
            unset($rowsArray);
            return $collection;
        }
    }  
?>