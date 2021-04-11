<?php
namespace Controller\Admin;

    \Mage::loadFileByClassName("Controller\Core\Admin");

    class Customer extends \Controller\Core\Admin
    {

        public function gridAction()
        {
            try 
            {
                $gridHtml = \Mage::getBlock('Admin\Customer\Grid')->toHtml();
                $response = [
                    'element' => [
                        'selector' => '#contentHtml',
                        'html' => $gridHtml
                    ]
                ];
                header("Content-Type: application/json");
                echo json_encode($response);
                
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
        }
        
        public function formAction()
        {
            try 
            {
                $edit = \Mage::getBlock('Admin\Customer\Edit');
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

                $customer = \Mage::getModel('Customer'); 
                if($customerId = (int) $this->getRequest()->getGet('customerId'))
                {
                    $customer->load($customerId);
                    $customer->updateddate = date("Y-m-d H:i:s");

                    if(!$customer)
                    {
                        $this->getMessage()->setFailure('Unable To Process Data.');  
                    }
                }
                $customerData = $this->getRequest()->getPost('customer');
                $customer->setData($customerData);
                $customer->createddate = date("Y-m-d H:i:s");
                $customer->save();

                
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->gridAction();
        }
        public function deleteAction()
        {
            try 
            {
                $customerId = $this->getRequest()->getGet('customerId');
                $customer = \Mage::getModel('Customer');
                if(!$customerId)
                {
                    $this->getMessage()->setFailure('Id not found.');
                }
                $customer->load($customerId);
                if(!$customer)
                {
                    $this->getMessage()->setFailure('Data not found.');
                }
                $customer->delete($customerId);
               
                
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }  
            $this->gridAction();
        }

        public function statusAction()
        {
            try 
           {
               $customerId = (int) $this->getRequest()->getGet('customerId');
               if(!$customerId)
                {
                    throw new \Exception("Id not found", 1);   
                }
                $customer = \Mage::getModel('Customer');
                $customer->load($customerId);
                if($customer->status == 1)
                {
                    $customer->status = 0;
                }
                else
                {
                    $customer->status = 1;
                }
                $customer->save();

            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->gridAction();
        }

        public function filterAction()
        {
            
            try 
            {
                $filters = $this->getRequest()->getPost('filter');
            
                $filter = \Mage::getModel('Core\Filter');
                $filter->setFilters($filters);

            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->gridAction();
        }
    }
?>