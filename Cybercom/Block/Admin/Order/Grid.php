<?php 
namespace Block\Admin\Order;

    \Mage::loadFileByClassName('Block\Core\Template');

    class Grid extends \Block\Core\Template
    {
        protected $order = [];

        public function __construct()
        {
            $this->setTemplate('./view/admin/order/grid.php');
        }

        public function setOrder($customerId)
        {
            $orderModel = \Mage::getModel('Order');
            $query = "SELECT * FROM `{$orderModel->getTableName()}` WHERE `customerId` = '{$customerId}'";
            $this->order = $orderModel->fetchAll($query);
            return $this;
        }

        public function getOrder()
        {
            return $this->order;
        }
    }
?>