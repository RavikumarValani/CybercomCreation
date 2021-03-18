<?php

    Mage::loadFileByClassName("Controller_Core_Admin");

    class Controller_Payment extends Controller_Core_Admin 
    {
        public function gridAction()
        {
            try 
            {
                $layout = Mage::getBlock('Core_Layout');
                $grid = Mage::getBlock('Payment_Grid');
                $layout = $this->getLayout();

                $content = Mage::getBlock('Core_Layout_Content');
                $content = $layout->getContent();
                $content->addChild($grid);

                echo $this->tolayoutHtml();
            } catch (Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            
        }
        
        public function formAction()
        {
            try 
            {
                $EditBlock = Mage::getBlock('Payment_Edit');

                $layout = $this->getLayout();

                $content = Mage::getBlock('Core_Layout_Content');
                $content = $layout->getContent();
                $content->addChild($EditBlock);

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
                if (!$this->getRequest()->isPost()) 
                {
                    $this->getMessage()->setFailure('Unable To Process Request.');
                }
                $payment = Mage::getModel('Payment'); 
                $paymentData = $this->getRequest()->getPost('payment');
                $payment->setData($paymentData);
                $payment->save();
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
               $payment = Mage::getModel('Payment');
               if($payment->delete($id))
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
            $this->redirect('grid');

        }

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
                    $this->getMessage()->setFailure('Unable To Process Request.');       
               }
               if($status == 0)
               {
                   $query = "UPDATE `payment` SET `status`=1 WHERE `id` = {$id}";
                   $adapter = Mage::getModel('Core_Adapter');
                   $adapter->update($query);
               }
               if($status == 1)
               {
                   $query = "UPDATE `payment` SET `status`=0 WHERE `id` = {$id}";
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