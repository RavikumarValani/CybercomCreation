<?php 
namespace Block\Admin\Order;

    \Mage::loadFileByClassName('Block\Core\Template');

    class Order extends \Block\Core\Template
    {

        public function __construct()
        {
            $this->setTemplate('./view/admin/order/order.php');
        }
    }
?>