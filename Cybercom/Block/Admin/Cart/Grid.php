<?php 
namespace Block\Admin\Cart;

    \Mage::loadFileByClassName('Block\Core\Template');

    class Grid extends \Block\Core\Template
    {
        protected $cart = null;

        public function __construct()
        {
            $this->setTemplate('./view/admin/cart/grid.php');
        }

        public function setCart(\Model\Cart $cart )
        {
            $this->cart = $cart;
            return $this;
        }

        public function getCart()
        {
            if(!$this->cart)
            {
                throw new \Exception("Cart Is Not Set "); 
            }
            return $this->cart;
        }

        public function getCustomers()
        {
            $customer =  \Mage::getModel('Customer');
            return $customer->fetchAll();
        }

        public function getId()
        {
            $query = "SELECT * FROM `cart` ";
        }
        
    }
?>