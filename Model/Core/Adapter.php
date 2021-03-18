<?php
    class Model_Core_Adapter 
    {
        private $connect = null;

        private $config = [
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
            'db' => 'shop'
        ];

        public function connection()
        {
            $connect = mysqli_connect($this->config['host'],$this->config['username'],$this->config['password'],$this->config['db']);
            $this->setConnection($connect);
        }

        public function setConnection(mysqli $connect)
        {
            $this->connect = $connect;
            return $this;
        }
        public function getConnection()
        {
            return $this->connect;
        }

        public function isConnected()
        {
            if(!$this->getConnection()) 
            {
                return false;
            }
            return true;
        }

        public function insert($query)
        {
            if (!$this->isConnected()) 
            {
                $this->connection();
            }

            $result = $this->getConnection()->query($query);

            if (!$result) 
            {
                return false;
            }
            return $this->getConnection();
        }

        public function update($query)
        {
            if (!$this->isConnected()) 
            {
                $this->connection();
            }

            $result = $this->getConnection()->query($query);

            if (!$result) 
            {
                return false;
            }
            return true;
        }

        public function delete($query)
        {
            if (!$this->isConnected()) 
            {
                $this->connection();
            }

            $result = $this->getConnection()->query($query);

            if (!$result) 
            {
                return false;
            }
            return true;
        }
        public function fetchAll($query)
        {
            if (!$this->isConnected()) 
            {
                $this->connection();
            }

            $result = $this->getConnection()->query($query);
            $data = $result->fetch_all(MYSQLI_ASSOC);

            if (!$data) 
            {
                return false;
            }
            return $data;
        }
        public function fetchRow($query)
        {
            if (!$this->isConnected()) 
            {
                $this->connection();
            }
            
            $result = $this->getConnection()->query($query);
            $data = $result->fetch_assoc();

            if (!$data) 
            {
                return false;
            }
            return $data;
        }
    }  
?>