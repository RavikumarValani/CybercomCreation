<?php
namespace Model;

    \Mage::loadFileByClassName("Model\Core\Table");

    class Shipping extends \Model\Core\Table
    {
        const STATUS_ENABLE = 1;
        const STATUS_DISABLE = 0;

        public function __construct()
        {
            $this->setTableName('shipping');
            $this->setPrimaryKey('shippingId');
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