<?php 
namespace Controller\Admin\Customer;

    \Mage::loadFileByClassName('Controller\Core\Admin');

    class Address extends  \Controller\Core\Admin
    {
        public function formAction()
        {
            try 
            {
                $EditBlock = \Mage::getBlock('Admin\Customer\Edit\Tabs\Address');
                $leftBar = \Mage::getBlock('Admin\Customer\Edit\Tabs'); 

                $layout = $this->getLayout();

                $content = \Mage::getBlock('Core\Layout\Content');
                $content = $layout->getContent();
                $content->addChild($EditBlock);

                $leftContent = \Mage::getBlock('Core\Layout\Left');
                $leftContent = $layout->getLeft();
                $leftContent->addChild($leftBar);

                $customer = \Mage::getModel('Customer'); 
                if($customerId = (int) $this->getRequest()->getGet('customerId'))
                {
                    $customer->load($customerId);
                    if(!$customer)
                    {
                        $this->getMessage()->setFailure('Unable To Process Data.');  
                    }
                }

                $EditBlock->setTableRow($customer);
                $this->tolayoutHtml();
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->redirect('grid');
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
            $this->redirect('form','Customer',['customerId' => $customerId],true);
        }
    }
    
?>