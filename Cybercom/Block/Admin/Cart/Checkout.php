<?php 
namespace Block\Admin\Cart;

    \Mage::loadFileByClassName('Block\Core\Template');

    class Checkout extends  \Block\Core\Template
    {

        protected $price = null;
        protected $totalPrice = null;
        protected $cart = null;

        public function __construct()
        {
            $this->setTemplate('./view/admin/cart/checkout.php');
        }
        public function getCart()
        {   
            $customerId = $_SESSION['admin']['customerId'];
            $cart = \Mage::getModel('Cart');
            $cart = $cart->load($customerId, 'customerId');
            $this->cart = $cart;
            return $this->cart;
        }

        public function getPaymentMethods()
        {
            $paymentMethod = \Mage::getModel('Payment');
            $query = "SELECT * FROM `{$paymentMethod->getTableName()}`
            WHERE `status` = 1";
            return $paymentMethod->fetchAll($query);
        }

        public function getBillingAddress()
        {
            
            if($billingAddress = $this->getCart()->getBillingAddress())
            {
                return $billingAddress;
            }
            else
            {
                $billingAddress = $this->getCart()->getCustomer()->getBillingAddress();
                if($billingAddress)
                {
                    $cartAddress = \Mage::getModel('Cart\Address');
                    $cartAddress->setData($billingAddress->getOriginalData());
                    $cartId = $this->getCart()->getOriginalData()['cartId'];
                    $cartAddress->cartId = $cartId; 
                    $cartAddress->save();
                    return $this->getCart()->getBillingAddress();
                }
                else
                {
                    $cartAddress = \Mage::getModel('Cart\Address');
                    $query = "SELECT * FROM `{$cartAddress->getTableName()}` WHERE `customerId` = 0 ";
                    $row = $cartAddress->fetchRow($query);
                    return $row;
                }
            }
            
        }

        public function getShippingAddress()
        {
            
            if($shippingAddress = $this->getCart()->getShippingAddress())
            {
                return $shippingAddress;
            }
            else
            {
                $shippingAddress = $this->getCart()->getCustomer()->getShippingAddress();
                if($shippingAddress)
                {
                    $cartAddress = \Mage::getModel('Cart\Address');
                    $cartAddress->setData($shippingAddress->getOriginalData());
                    $cartId = $this->getCart()->getOriginalData()['cartId'];
                    $cartAddress->cartId = $cartId; 
                    $cartAddress->save();
                    return $this->getCart()->getShippingAddress();
                }
                else
                {
                    $cartAddress = \Mage::getModel('Cart\Address');
                    $query = "SELECT * FROM `{$cartAddress->getTableName()}` WHERE `customerId` = 0 ";
                    $row = $cartAddress->fetchRow($query);
                    return $row;
                }
            }
            
        }

        public function getShippingMethods()
        {
            $shipping = \Mage::getModel('Shipping');
            $query = "SELECT shippingId,name,amount,code FROM `{$shipping->getTableName()}` WHERE `status` = 1";
            return $shipping->fetchAll($query);
        }

        public function calculatePrice($price)  
        {
            $this->price = $this->price + $price;
        }

        public function getPrice()
        {
            return $this->price;
        }

        public function totalPrice($price, $discount)
        {
            $this->totalPrice = $this->totalPrice + ($price * $discount);
        }

        public function getTotalPrice()
        {
            return $this->totalPrice;
        }

        public function getName($productId)
        {
            $product = \Mage::getModel('Product');
            $query = "SELECT name FROM `{$product->getTableName()}` WHERE `{$product->getPrimaryKey()}` = {$productId}";
            return $product->fetchRow($query)->name;
        }

        
    }
    
?>