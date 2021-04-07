<?php 
namespace Model;

    \Mage::loadFileByClassName('Model\Core\Table');

    class Order extends \Model\Core\Table
    {
        public function __construct()
        {
            $this->setTableName('ordertable');
            $this->setPrimaryKey('orderId');
        }
    }
    
?>