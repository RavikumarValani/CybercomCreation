<?php
namespace Controller\Admin;

    \Mage::loadFileByClassName("Controller\Core\Admin");

    class Shipping extends \Controller\Core\Admin 
    {
        public function gridAction()
        {
            try 
            {

                $gridHtml = \Mage::getBlock('Block\Shipping\Grid')->toHtml();
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
                $shipping = \Mage::getModel('Shipping'); 
                $shippingData = $this->getRequest()->getPost('shipping');
                $shipping->setData($shippingData);
                $shipping->save();
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
                $id = $this->getRequest()->getGet('shippingId');
                $shipping = \Mage::getModel('Shipping');
                if($shipping->delete($id))
                {
                    $this->getMessage()->setSuccess('Record Delete Successful.');
                }
                else
                {
                    $this->getMessage()->setFailure('Unable To Delete Record.');
                }
                // $gridHtml = \Mage::getBlock('Shipping\Grid')->toHtml();
                // $response = [
                //     'status' => 'success',
                //     'message' => 'hello',
                //     'element' => [
                //         'selector' => '#contentHtml',
                //         'html' => $gridHtml
                //     ]
                // ];
                // header("Content-Type: application/json");
                // echo json_encode($response);
            } catch (\Exception $e) {
               $this->getMessage()->setFailure($e->getMessage());
            }
            
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
           $this->redirect('grid', null, null, true);
        }

        public function filterAction()
        {
            $filters = $this->getRequest()->getPost('filter');

            $filter = \Mage::getModel('Core\Filter');
            $filter->setFilters($filters);
            
            $this->redirect('grid', null, null, true);

        }
    }
?>