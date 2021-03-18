<?php

    Mage::loadFileByClassName("Controller_Core_Admin");

    class Controller_Customer extends Controller_Core_Admin
    {

        public function gridAction()
        {
            try 
            {
                $layout = Mage::getBlock('Core_Layout');
                $grid = Mage::getBlock('Customer_Grid');
                $layout = $this->getLayout();

                $content = Mage::getBlock('Core_Layout_Content');
                $content = $layout->getContent();
                $content->addChild($grid);

                $this->tolayoutHtml();
            } catch (Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
        }
        
        public function formAction()
        {
            try 
            {
                $EditBlock = Mage::getBlock('Customer_Edit');
                $leftBar = Mage::getBlock('Customer_Edit_Tabs'); 

                $layout = $this->getLayout();

                $content = Mage::getBlock('Core_Layout_Content');
                $content = $layout->getContent();
                $content->addChild($EditBlock);

                $leftContent = Mage::getBlock('Core_Layout_Left');
                $leftContent = $layout->getLeft();
                $leftContent->addChild($leftBar);

                $this->tolayoutHtml();
            } catch (Exception $e) {
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

                $customer = Mage::getModel('Customer'); 
                if($id = (int) $this->getRequest()->getGet('customerId'))
                {
                    $customer->load($id);
                    if(!$customer)
                    {
                        $this->getMessage()->setFailure('Unable To Process Data.');  
                    }
                }
                $customerAddress = Mage::getModel('CustomerAddress'); 
                $addressId = (int) $this->getRequest()->getGet('addressId');
                if(!$addressId)
                {
                    $this->setMessage('Id Not Found.');
                }
                if ($customerData = $this->getRequest()->getPost('customer')) 
                {
                    $customer->setData($customerData);
                    $customer->save();
                }
                else
                {
                    $addressData = $this->getRequest()->getPost('address');
                    $customerAddress->setData($addressData);
                    $customerAddress->save();
                }
                $this->getMessage()->setSuccess('Record Save Successful.');
            } catch (Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->redirect('grid');
        }
        public function deleteAction()
        {
            try 
            {
                $id = $this->getRequest()->getGet('id');
                $customer = Mage::getModel('Customer');
                if($customer->delete($id))
                {
                    $this->getMessage()->setSuccess('Record Delete Successful.');
                }
                else
                {
                    $this->getMessage()->setFailure('Unable To Delete Record.');
                }
                
            } catch (Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->redirect('grid');   }
        public function statusAction()
        {
            try 
           {
               $id = (int) $this->getRequest()->getGet('id');
               $status = (int) $this->getRequest()->getGet('status');
               if(!$id)
                {
                    $this->getMessage()->setFailure('Id Not Found.');   
                }
               if(!($status == 0) && !($status == 1))
               {
                    $this->getMessage()->setFailure('Unable To Process Request');       
               }
               if($status == 0)
               {
                   $query = "UPDATE `customer` SET `status`=1 WHERE `id` = {$id}";
                   $adapter = Mage::getModel('Core_Adapter');
                   $adapter->update($query);
               }
               if($status == 1)
               {
                   $query = "UPDATE `customer` SET `status`=0 WHERE `id` = {$id}";
                   $adapter = Mage::getModel('Core_Adapter');
                   $adapter->update($query);
               }
           } catch (Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
           }
           $this->redirect('grid');
        }
    }
?>