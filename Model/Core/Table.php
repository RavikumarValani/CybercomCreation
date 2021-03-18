<?php 
    Mage::getModel('Core_Adapter');
    class Model_Core_Table 
    {
        protected $adapter = null;

        protected $primaryKey = null;
        protected $tableName = null;
        protected $data = [];

        public function setAdapter($adapter = null)
        {
            if (!$adapter) 
            {
                $adapter = new Model_Core_Adapter();
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

        public function __set($key,$value)
        {
            $this->data[$key] = $value;
            return $this;
        }
        public function __get($key)
        {
            if(!array_key_exists($key,$this->data))
            {
                return null;
            }
            return $this->data[$key];
        }

        public function save()
        {
            if(!array_key_exists($this->getPrimaryKey() , $this->data))
            {
                if (!($this->getTableName() == 'customer_address' || $this->getTableName() == 'attribute_option' || $this->getTableName() == 'attribute')) {
                    $this->createddate = date("Y-m-d");
                }
                echo $query = "INSERT INTO `{$this->getTableName()}` (`".implode('`,`',array_keys($this->data))."`) VALUES ('".implode('\',\'',array_values($this->data))."' )";
                $this->getAdapter()->insert($query); 
                $query = "SELECT `{$this->getPrimaryKey()}` FROM `{$this->getTableName()}` ORDER BY {$this->getPrimaryKey()} DESC ";
                $data = $this->getAdapter()->fetchRow($query);
                $this->data[$this->primaryKey] = $data[$this->primaryKey];         
            }
            else
            {
                if (!($this->getTableName() == 'attribute_option')) {
                    $this->updateddate = date("Y-m-d");
                }
                $params = null;

                foreach ($this->data as $key => $value) {
                    $params[] = "$key = '$value'";
                }
                $query = "UPDATE `{$this->getTableName()}` SET ". implode(', ', $params)." WHERE {$this->getPrimaryKey()}={$this->data[$this->getPrimaryKey()]}";
                $this->getAdapter()->update($query);
            }
            $this->load($this->getPrimaryKey());
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

        public function load($value)
        {
            $id =(int) $value;
            $query = "SELECT * FROM `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}` = {$id}";
            return $this->fetchRow($query);
        }

        public function fetchRow($query)
        {
            $data = $this->getAdapter()->fetchRow($query);
            if (!$data) 
            {
                return false;
            }
            $this->setData($data);
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
                $value = $row->setData($value);
                $rowsArray[] = $row;
            }
            
            $collectionClassName = get_class($this)."_Collection";
            $collectionClassName = str_replace("Model_",'',$collectionClassName);
            $collection = Mage::getModel($collectionClassName);
            $collection->setData($rowsArray);
            unset($rowsArray);
            return $collection;
        }
    }  
?>