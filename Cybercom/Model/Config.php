<?php
namespace Model;

    \Mage::loadFileByClassName("Model\Core\Table");
    
    class Config extends \Model\Core\Table
    {

        public function __construct()
        {
            $this->setTableName('config');
            $this->setPrimaryKey('configId');
        }

        public function getGroup()
        {
            
        }

        public function getGroups()
        {
            if(!$this->configId)
            {
                throw new \Exception('Unable To Find Id');
            }
            $query = "SELECT groupId FROM `{$this->getTableName()}` WHERE `configId` = '{$this->configId}'";
            $groupId = $this->fetchRow($query)->groupId;
            if(!$groupId)
            {
                throw new \Exception('Unable To Find Id');
                
            }
            $query = "SELECT * FROM `config_group`
            WHERE `groupId` = '{$groupId}' 
            ORDER BY groupId ASC";

            return \Mage::getModel('Config\Group')->fetchAll($query);
        }
    }
    
?>