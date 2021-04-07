<?php
namespace Model\Cart;

    \Mage::loadFileByClassName("Model\Core\Table");

    class Item extends \Model\Core\Table
    {
        protected $cart = null;
        protected $product = null;

        public function __construct()
        {
            $this->setTableName('cart_item');
            $this->setPrimaryKey('itemId');
        }

        public function setCart(\Model\Cart $cart)
        {
            $this->cart = $cart;
            return $this;
        }
        public function getCart()
        {
            if(!$this->cartId)
            {
                return false;
            }

            $cart = \Mage::getModel('Cart')->load($this->cartId);
            $this->setCart($cart);
            return $this->cart;
        }

        public function setProduct(\Model\Product $product)
        {
            $this->product = $product;
            return $this;
        }
        public function getProduct()
        {
            if(!$this->productId)
            {
                return false;
            }

            $product = \Mage::getModel('Product')->load($this->productId);
            $this->setCart($product);
            return $this->product;
        }
    }
    
?>