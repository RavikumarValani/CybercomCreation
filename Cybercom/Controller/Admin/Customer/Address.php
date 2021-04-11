<?php 
namespace Controller\Admin\Customer;

    \Mage::loadFileByClassName('Controller\Core\Admin');

    class Address extends  \Controller\Core\Admin
    {
        public function formAction()
        {
            try 
            {
                $edit = \Mage::getBlock('Admin\Customer\Edit\Tabs\Address');
                $customer = \Mage::getModel('Customer'); 
                if($customerId = (int) $this->getRequest()->getGet('customerId'))
                {
                    $customer->load($customerId);
                    if(!$customer)
                    {
                        $this->getMessage()->setFailure('Unable To Process Data.');  
                    }
                }
                
                $edit->setTableRow($customer);

                $editHtml = $edit->toHtml();
                $leftBar = \Mage::getBlock('Admin\Customer\Edit\Tabs')->toHtml(); 

                $response = [
                    'element' => [
                        [
                            'selector' => '#contentHtml',
                            'html' => $editHtml
                        ],
                        [
                            'selector' => '#tabContent',
                            'html' => $leftBar
                        ]
                    ]
                ];
                header("Content-Type: application/json");
                echo json_encode($response);
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
        }

        public function saveAction()
        {
            try 
            {
                if (!$this->getRequest()->isPost()) {

                    $this->getMessage()->setFailure('Unable To Process Request.');
                    
                }
                $customerId = (int) $this->getRequest()->getGet('customerId');
                
                $billingAddressData = $this->getRequest()->getPost('billingAddress');
                if($billingAddressData)
                {
                    $customerAddress = \Mage::getModel('Customer\Address'); 
                    if($customerId)
                    {
                        $type = \Model\Customer\Address::TYPE_BILLING;
                        $query = "SELECT * FROM `{$customerAddress->getTableName()}` WHERE `customerId` = '{$customerId}' AND `type` = '{$type}'";
                        $customerAddress->fetchRow($query);
                        if(!$customerAddress)
                        {
                            $this->getMessage()->setFailure('Data not found.');
                        }
                    }

                    $customerAddress->setData($billingAddressData);
                    $customerAddress->customerId = $customerId;
                    $customerAddress->save();
                }
                $shippingAddressData = $this->getRequest()->getPost('shippingAddress');
                if($shippingAddressData)
                {
                    $customerAddress = \Mage::getModel('Customer\Address'); 

                    if($customerId)
                    {
                        $type = \Model\Customer\Address::TYPE_SHIPPING;
                        $query = "SELECT * FROM `{$customerAddress->getTableName()}` WHERE `customerId` = '{$customerId}' AND `type` = '{$type}'";
                        $customerAddress->fetchRow($query);
                        if(!$customerAddress)
                        {
                            $this->getMessage()->setFailure('Data not found.');
                        }
                    }

                    $customerAddress->setData($shippingAddressData);
                    $customerAddress->customerId = $customerId;
                    $customerAddress->save();
                }
                
                
            
                $this->getMessage()->setSuccess('Record Save Successful.');
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
        }
    }
    
?>