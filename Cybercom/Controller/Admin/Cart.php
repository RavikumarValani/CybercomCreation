<?php 
namespace Controller\Admin;

    \Mage::loadFileByClassName('Controller\Core\Admin');

    class Cart extends \Controller\Core\Admin
    {
        public function addToCartAction()
        {
            
            try {
                
                $productId = (int) $this->getRequest()->getGet('productId');
                $product = \Mage::getModel('Product')->load($productId);

                if(!$product)
                {
                    throw new \Exception("Product is not valid");
                    
                }

                $cart = $this->getCart();
                $cart->addItemToCart($product, 1, true);
                
                $this->getMessage()->setSuccess('Item successfully added into cart');            


            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());            
            }

            $this->redirect('index');
        }

        protected function getCart($customerId = null)
        {

            $session = \Mage::getModel('Admin\Session');
            if($customerId)
            {
                $session->customerId = $customerId;
            }
            $cart = \Mage::getModel('Cart');
            $query = "SELECT * FROM `{$cart->getTableName()}` WHERE `customerId` = '{$session->customerId}'"; 
            $cart = $cart->fetchRow($query);
            
            if($cart)
            {
                return $cart;
            }

            $cart = \Mage::getModel('Cart');
            $cart->customerId = $session->customerId;
            $cart->createddate = date("Y-m-d H:i:s");
            $cart->save();
            return $cart;
            
        }

        public function indexAction()
        {
            try
            {
                $gridHtml = \Mage::getBlock('Admin\Cart\Grid')->toHtml();
                $response = [
                    'element' => [
                        'selector' => '#contentHtml',
                        'html' => $gridHtml
                    ]
                ];
                header("Content-Type: application/json");
                echo json_encode($response);

                $cart = $this->getCart();
                $gridHtml->setCart($cart);

            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }

        }

        public function updateAction()
        {
            try {
                
                $quantities = $this->getRequest()->getPost('quantity');

                $cart = $this->getCart();
                
                foreach ($quantities as $cartItemId => $qantity) {
                    $cartItem = \Mage::getModel('Cart\Item')->load($cartItemId);
                    if($qantity == 0)
                    {
                        $cartItem->delete($cartItemId);
                        $this->redirect('index');
                    }
                    $cartItem->quantity = $qantity;
                    $cartItem->save();
                }
                $this->getMessage()->setSuccess('Item update successfully.');            

            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());            
            }

            $this->redirect('index');

        }

        public function deleteAction()
        {
            try 
            {
                $itemId = $this->getRequest()->getGet('id');
                $item = \Mage::getModel('Cart\Item');
                $item->delete($itemId);
                if(!$itemId)
                {
                     $this->getMessage()->setFailure('Id Not Found.');
                }

                if($item->delete($itemId))
                {
                     $this->getMessage()->setSuccess('Record Successful Deleted.');
                }
                else{
                     $this->getMessage()->setFailure('Unable to Delete Record');
                }
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->redirect('index',null,null,true);
        }

        public function selectCustomerAction()
        {
            $customerData = $this->getRequest()->getPost('customer');
            $customerId = $customerData['customerId'];
            $session = \Mage::getModel('Admin\Session');
            $session->customerId = $customerId;
            $cart = $this->getCart($customerId);
            
            $this->redirect('index',null,null,true);
        }
    }
?>