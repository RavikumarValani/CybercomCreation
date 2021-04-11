<?php
namespace Controller\Admin;

    \Mage::loadFileByClassName("Controller\Core\Admin");

    class Payment extends \Controller\Core\Admin 
    {
        public function gridAction()
        {
            try 
            {
                $gridHtml = \Mage::getBlock('Admin\Payment\Grid')->toHtml();
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
                $formHtml = \Mage::getBlock('Admin\Payment\Edit\Tabs\Form')->toHtml();
                $response = [
                    'element' => [
                        'selector' => '#contentHtml',
                        'html' => $formHtml
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
                if (!$this->getRequest()->isPost()) 
                {
                    $this->getMessage()->setFailure('Unable To Process Request.');
                }
                $payment = \Mage::getModel('Payment'); 
                $paymentData = $this->getRequest()->getPost('payment');
                $payment->setData($paymentData);
                $payment->createddate = date("Y-m-d H:i:s");
                $payment->save();
                $this->getMessage()->setSuccess('Record Save Successful.');
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->gridAction();
        }
       public function deleteAction()
       {
           try 
           {
                $paymentId = $this->getRequest()->getGet('paymentId');
                $payment = \Mage::getModel('Payment');
                if(!$paymentId)
                {
                    $this->getMessage()->setFailure("Id not found.");
                }
                $payment->load($paymentId);
                if(!$payment)
                {
                    $this->getMessage()->setFailure("Data not found.");
                }
                $payment->delete($paymentId);
                
            } catch (\Exception $e) {
               $this->getMessage()->setFailure($e->getMessage());
            }
            $this->gridAction();

        }

        public function statusAction()
        {
            try 
           {
               $id = (int) $this->getRequest()->getGet('paymentId');
               if(!$id)
                {
                    throw new \Exception("Id not found", 1);   
                }
                $payment = \Mage::getModel('Payment');
                $payment->load($id);
                if($payment->status == 1)
                {
                    $payment->status = 0;
                }
                else
                {
                    $payment->status = 1;
                }
                $payment->save();

           } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
           }
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