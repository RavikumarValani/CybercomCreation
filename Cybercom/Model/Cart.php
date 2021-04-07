<?php
namespace Model;


\Mage::loadFileByClassName("Model\Core\Table");

    class Cart extends \Model\Core\Table
    {
        protected $customer = null;
        protected $items = [];
        protected $billingAddress = null;
        protected $shippingAddress = null;
        protected $shippingMethodId = null;

        public function __construct()
        {
            $this->setTableName('cart');
            $this->setPrimaryKey('cartId');
        }

        public function setCustomer(\Model\Customer $customer)
        {
            $this->customer = $customer;
            return $this;
        }
        public function getCustomer()
        {
            if($this->customer)
            {
                return $this->customer;
            }
            if(!$this->customerId)
            {
                return false;
            }
            $customer = \Mage::getModel('Customer')->load($this->customerId);
            $this->setCustomer($customer);
            return $this->customer;
        }

        public function setItems(\Model\Cart\Item\Collection $items)
        {
            $this->items = $items;
            return $this;
        }
        public function getItems()
        {
            if(!$this->cartId)
            {
                return false;
            }
            $item = \Mage::getModel('Cart\Item');
            $query = "SELECT * FROM `{$item->getTableName()}` WHERE `cartId` = '{$this->cartId}'";
            $item = $item->fetchAll($query);
            if($item == null)
            {
                return null;
            }
            $this->setItems($item);
            return $this->items;
        }

        public function setBillingAddress(\Model\Cart\Address $billingAddress)
        {
            $this->billingAddress = $billingAddress;
            return $this;
        }
        public function getBillingAddress()
        {
            if(!$this->cartId)
            {
                return false;
            }

            $address = \Mage::getModel('Cart\Address');
            $type = \Model\Cart\Address::TYPE_BILLING;
            $query = "SELECT * FROM `{$address->getTableName()}` WHERE `cartId` = '{$this->cartId}' AND `type` = '{$type}' ";
            $billingAddress = $address->fetchRow($query);
            if(!$billingAddress)
            {
                return null;
            }
            $this->setBillingAddress($billingAddress);
            return $this->billingAddress;
        }

        public function setShippingAddress(\Model\Cart\Address $shippingAddress)
        {
            $this->shippingAddress = $shippingAddress;
            return $this;
        }
        public function getShippingAddress()
        {
            if(!$this->cartId)
            {
                return $this;
            }

            $address = \Mage::getModel('Cart\Address');
            $type = \Model\Cart\Address::TYPE_SHIPPING;
            $query = "SELECT * FROM `{$address->getTableName()}` WHERE `cartId` = '{$this->cartId}' AND `type` = '{$type}' ";
            $shippingAddress = $address->fetchRow($query);
            if(!$shippingAddress)
            {
                return null;
            }
            $this->setShippingAddress($shippingAddress);
            return $this->shippingAddress;
        }

        public function setShippingMethodId(\Model\Shipping $shippingId)
        {
            $this->shippingMethodId = $shippingId;
            return $this;
        }
        public function getShippingMethodId()
        {
            if(!$this->shippingmethodId)
            {
                return false;
            }

            $shipping = \Mage::getModel('Shipping');
            $query = "SELECT id FROM `{$shipping->getTableName()}` ";
            $shippingMethodId = $shipping->fetchRow($query);
            $this->setShippingMethodId($shippingMethodId);
            return $this->shippingMethodId;
        }

        public function addItemToCart($product, $quantity = 1, $addMode = false)
        {
            $query = "SELECT * FROM `cart_item` WHERE `cartId` = '{$this->cartId}' AND `productId` = '{$product->productId}' ";

            $cartItem = \Mage::getModel('Cart\Item');
            $cartItem = $cartItem->fetchRow($query);

            if($cartItem)
            {
                $cartItem->quantity += $quantity;
                $cartItem->save();
                return true; 
            }
            
            $cartItem = \Mage::getModel('Cart\Item');

            $cartItem->cartId = $this->cartId;
            $cartItem->productId = $product->productId;
            $cartItem->price = $product->price;
            $cartItem->quantity = $quantity;
            $cartItem->discount = $product->discount;
            $cartItem->createddate = date("Y-m-d H:i:s");

            $cartItem->save();

            return true;
        }
    }
    
?>