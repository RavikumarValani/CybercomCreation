<?php 
namespace Controller\Admin\Cart;

    \Mage::loadFileByClassName('Controller\Core\Admin');

    class Checkout extends \Controller\Core\Admin
    {
        public function indexAction()
        {
            $gridHtml = \Mage::getBlock('Admin\Cart\Checkout')->toHtml();
                $response = [
                    'element' => [
                        'selector' => '#contentHtml',
                        'html' => $gridHtml
                    ]
                ];
                header("Content-Type: application/json");
                echo json_encode($response);
        }

        public function saveAction()
        {
            try 
            {
                $addressData = $this->getRequest()->getPost('billingAddress');
                $cartAddress = \Mage::getModel('Cart\Address');
                $customerAddress = \Mage::getModel('Customer\Address');
                $customerId = $_SESSION['admin']['customerId'];
                
                if($addressData)
                {
                    if($this->getRequest()->getPost('shippingFlag'))
                    {
                        if($customerId)
                        {
                            $query = "SELECT cartAddressId FROM `{$cartAddress->getTableName()}` WHERE `customerId` = '{$customerId}' AND `type` = 'shipping' ";
                            $cartAddressData = $cartAddress->fetchRow($query);
                            if(!$cartAddressData)
                            {
                                exit;
                            }
                            $cartAddressId = $cartAddressData->cartAddressId;
                            $cartAddress->load($cartAddressId);
                        }
                        $cartAddress->setData($addressData);
                        $cartAddress->save();
                    }

                    if($this->getRequest()->getPost('adressBookFlag'))
                    {
                        $query = "SELECT addressId FROM `{$customerAddress->getTableName()}` WHERE `customerId` = '{$customerId}' AND `type` = 'billing' ";
                        $customerAddressData = $customerAddress->fetchRow($query);
                        if($customerAddressData)
                        {
                            $customerAddressId = $customerAddressData->customerAddressId;
                            $customerAddress->load($customerAddressId);
                        }
                        $customerAddress->customerId = $customerId;
                        $customerAddress->type = 'billing';
                        $customerAddress->setData($addressData);
                        $customerAddress->save();
                    }


                    if($customerId)
                    {
                        $cartAddress->load($customerId, 'customerId');
                    }
                    $cartId = \Mage::getBlock('Admin\Cart\Checkout')->getCart()->cartId;
                    $cartAddress->cartId = $cartId;
                    $cartAddress->customerId = $customerId;
                    $cartAddress->type = 'billing';

                    $cartAddress->setData($addressData);
                    
                    $cartAddress->save();
                }
                else
                {
                    $addressData = $this->getRequest()->getPost('shippingAddress');

                    if($this->getRequest()->getPost('adressBookFlag'))
                    {
                       $customerAddress = \Mage::getModel('Customer\Address');
                       if($customerId)
                       {
                           $customerAddress->load($customerId, 'customerId');
                       }
                       $customerAddress->customerId = $customerId;
                       $customerAddress->type = 'shipping';
                       $customerAddress->setData($addressData);
                       $customerAddress->save();
                    }

                    if($customerId)
                    {
                        $query = "SELECT cartAddressId FROM `{$cartAddress->getTableName()}` WHERE `customerId` = '{$customerId}' AND `type` = 'shipping' ";
                        $cartAddressData = $cartAddress->fetchRow($query);
                        if($cartAddressData)
                        {
                            $cartAddressId = $cartAddressData->cartAddressId;
                            $cartAddress->load($cartAddressId);
                        }
                    } 
                    $cartAddress->customerId = $customerId;
                    $cartId = \Mage::getBlock('Admin\Cart\Checkout')->getCart()->cartId;
                    $cartAddress->cartId = $cartId;
                    $cartAddress->type = 'shipping';
                    $cartAddress->setData($addressData);
                    $cartAddress->save();
                }
                
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }  
            $this->indexAction(); 
        }

        public function saveDetailsAction()
        {
            $shippingData = $this->getRequest()->getPost('shipping');
            $paymentId = $this->getRequest()->getPost('payment');
            

            $productData = $this->getRequest()->getPost('product');

            $cart = \Mage::getModel('Cart');
            $customerId = $_SESSION['admin']['customerId'];
            $query = "SELECT cartId FROM `{$cart->getTableName()}` WHERE `customerId` = '{$customerId}'";
            $cartId = $cart->fetchRow($query)->cartId;
            $cart->load($cartId);
            if($paymentId)
            {
                $cart->paymentmethodId = $paymentId;
                $cart->save();
            }
            if(array_key_exists('shippingId', $shippingData))
            {
                $cart->shippingmethodId = $shippingData['shippingId'];
                foreach ($shippingData['amount']as $key => $value) {
                    if($key == $shippingData['shippingId'])
                    {
                        $cart->shippingAmount = $value;
                    }
                }
                $cart->save();
            }

            if($productData)
            {
                $cart->total = $productData['total'];
                $cart->discount = $productData['discount'];
                $cart->save();
            }
            $this->indexAction();
        }
    }
    
?>