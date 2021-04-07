<?php
namespace Model\Product\Group;

    \Mage::loadFileByClassName("Model\Core\Table");
    
    class Price extends \Model\Core\Table
    {
        const STATUS_ENABLE = 1;
        const STATUS_DISABLE = 0;

        public function __construct()
        {
            $this->setTableName('product_group_price');
            $this->setPrimaryKey('entityId');
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