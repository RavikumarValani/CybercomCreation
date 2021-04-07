<?php
namespace Model;

    \Mage::loadFileByClassName("Model\Core\Table");

    class Admin extends \Model\Core\Table
    {
        const STATUS_ENABLE = 1;
        const STATUS_DISABLE = 0;

        public function __construct()
        {
            $this->setTableName('admin');
            $this->setPrimaryKey('adminId');
        }

        public function getStatusOption()
        {
            return [
                self::STATUS_ENABLE => "Enable",
                self::STATUS_DISABLE => "Disable"
            ];
        }
    }
    
?>