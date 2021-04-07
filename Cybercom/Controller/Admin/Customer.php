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

                $this->getMessage()->setSuccess('Record Save Successful.');
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->redirect('grid');
        }
        public function deleteAction()
        {
            try 
            {
                $id = $this->getRequest()->getGet('id');
                $customer = \Mage::getModel('Customer');
                if($customer->delete($id))
                {
                    $this->getMessage()->setSuccess('Record Delete Successful.');
                }
                else
                {
                    $this->getMessage()->setFailure('Unable To Delete Record.');
                }
                
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->redirect('grid');   
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
            $this->redirect('grid', null, null, true);
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
            $this->redirect('grid', null, null, true);
        }
    }
?>