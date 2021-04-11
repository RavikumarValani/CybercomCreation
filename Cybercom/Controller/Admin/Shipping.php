<?php
namespace Controller\Admin;

    \Mage::loadFileByClassName("Controller\Core\Admin");

    class Shipping extends \Controller\Core\Admin 
    {
        public function gridAction()
        {
            try 
            {

                $gridHtml = \Mage::getBlock('Admin\Shipping\Grid')->toHtml();
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
                $formHtml = \Mage::getBlock('Admin\Shipping\Edit\Tabs\Form')->toHtml();
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
                $shipping = \Mage::getModel('Shipping'); 
                $shippingData = $this->getRequest()->getPost('shipping');
                $shipping->setData($shippingData);
                $shipping->save();
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
                $shippingId = $this->getRequest()->getGet('shippingId');
                $shipping = \Mage::getModel('Shipping');

                if(!$shippingId)
                {
                    $this->getMessage()->setSuccess('Id not found.');
                }
                $shipping->load($shippingId);
                if(!$shipping)
                {
                    $this->getMessage()->setFailure('Data not found.');
                }
                $shipping->delete($shippingId);
                
            } catch (\Exception $e) {
               $this->getMessage()->setFailure($e->getMessage());
            }
            $this->gridAction();
            
        }

        public function statusAction()
        {
            try 
           {
               $id = (int) $this->getRequest()->getGet('shippingId');
               if(!$id)
                {
                    throw new \Exception("Id not found", 1);   
                }
                $shipping = \Mage::getModel('Shipping');
                $shipping->load($id);
                if($shipping->status == 1)
                {
                    $shipping->status = 0;
                }
                else
                {
                    $shipping->status = 1;
                }
                $shipping->save();

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