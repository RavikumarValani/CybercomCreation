<?php 
namespace Controller\Admin;

    \Mage::loadFileByClassName('Controller\Core\Admin');

    class Order extends \Controller\Core\Admin
    {
        public function indexAction()
        {
            $block = \Mage::getBlock('Admin\Order\Order');
            $layout = $this->getLayout();
            $layout->getContent()->addChild($block);
            $this->toLayoutHtml();
        }

        public function saveAction()
        {
            try 
            {
                
                $customerId = \Mage::getModel('Admin\Session')->customerId;
                $cart = \Mage::getModel('Cart');
                $query = "SELECT cartId,customerId,paymentmethodId,shippingmethodId,shippingAmount,total,discount FROM `{$cart->getTableName()}` WHERE `customerId` = '{$customerId}'";
                $cartData = $cart->fetchRow($query)->getOriginalData();
                $cartId = $cartData['cartId'];
                unset($cartData['cartId']);
                if(!$cartData['paymentmethodId'])
                {
                    $this->getMessage()->setFailure('Please select payment method.');
                    $this->redirect('index', 'cart\checkout');
                }
                if(!$cartData['shippingmethodId'])
                {
                    $this->getMessage()->setFailure('Please select shipping method.');
                    $this->redirect('index', 'cart\checkout');
                }
                $order = \Mage::getModel('Order');
                
                $order->setData($cartData);
                $order->createddate = date("Y-m-d");
                $order->save();


                $cartItem = \Mage::getModel('Cart\Item');
                $query = "SELECT productId,price,discount,quantity FROM `{$cartItem->getTableName()}` WHERE `cartId` = '{$cartId}'";
                $cartItems = $cartItem->fetchAll($query)->getData();
                foreach ($cartItems as $key => $item) {
                    $orderItem = \Mage::getModel('Order\item');
                    $orderItem->setData($item->getOriginalData());
                    $orderItem->createddate = date("Y-m-d");
                    $orderItem->save();
                }

                $cartAddress = \Mage::getModel('Cart\Address');
                $query = "SELECT addressId,customerId,address,city,state,country,zip,type FROM `{$cartAddress->getTableName()}` WHERE `customerId` = '{$customerId}'";
                $cartAddress = $cartAddress->fetchAll($query);
                if (!$cartAddress) {
                    $this->getMessage()->setFailure('Please enter billing and shipping address');
                    $this->redirect('index', 'cart\checkout');
                } 
                $cartAddress = $cartAddress->getData();               
                foreach ($cartAddress as $key => $address) {
                    $orderAddress = \Mage::getModel('Order\Address');
                    $orderAddress->setData($address->getOriginalData());
                    $orderAddress->save();
                }

                $cart->delete($cartId);
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $session = \Mage::getModel('admin\session');
            $session->destroy();
            $this->redirect('index');
        }
    }
    
?>