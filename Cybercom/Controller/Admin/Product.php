<?php
namespace Controller\Admin;

    \Mage::loadFileByClassName("Controller\Core\Admin");

    class Product extends \Controller\Core\Admin 
    {
        public function gridAction()
        {
            try 
            {
                $gridHtml = \Mage::getBlock('Admin\Product\Grid')->toHtml();
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
                $edit = \Mage::getBlock('Admin\Product\Edit\Tabs\Form');
                
                $product = \Mage::getModel('Product');
                if($productId = (int) $this->getRequest()->getGet('productId'))
                {
                    $product->load($productId);
                    if(!$product)
                    {
                        $this->getMessage()->setFailure('Unable to Find Data.');   
                    }
                }
                $edit->setTableRow($product);

                $editHtml = $edit->toHtml();
                $leftBar = \Mage::getBlock('Admin\Product\Edit\Tabs')->toHtml(); 

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
            $this->redirect('grid',null,null,true);
        }
        public function saveAction()
        {
           try 
           {
                if (!$this->getRequest()->isPost()) 
                {
                    $this->getMessage()->setFailure('Invalid Request Id.');
                }
                $product = \Mage::getModel('Product'); 
                if($productId = (int) $this->getRequest()->getGet('productId'))
                {
                    
                    $product->load($productId);
                    $product->updateddate = date("Y-m-d H:i:s");
                    if(!$product)
                    {
                        $this->getMessage()->setFailure('Unable to Find Data.');   
                    }
                }
                $productData = $this->getRequest()->getPost('product');
                $product->createddate = date("Y-m-d H:i:s");
                $product->setData($productData);
                $product->save();
                $this->getMessage()->setSuccess('Record Successfully Save.');
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
           }
           $this->redirect('grid',null,null,true);
        }
        public function deleteAction()
        {
           try 
           {
               $productId = $this->getRequest()->getGet('productId');
               if(!$productId)
               {
                    $this->getMessage()->setFailure('Id Not Found.');
               }
               $product = \Mage::getModel('Product');
               if($product->delete($productId))
               {
                    $this->getMessage()->setSuccess('Record Successful Deleted.');
               }
               else{
                    $this->getMessage()->setFailure('Unable to Delete Record');
               }
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->redirect('grid', null, null, true);
        }
        
        public function statusAction()
        {
            try 
           {
               $productId = (int) $this->getRequest()->getGet('productId');
               if(!$productId)
                {
                    throw new \Exception("Id not found", 1);   
                }
                $product = \Mage::getModel('Product');
                $product->load($productId);
                if($product->status == 1)
                {
                    $product->status = 0;
                }
                else
                {
                    $product->status = 1;
                }
                $product->save();

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

        public function updateAction()
        {
            $attributeData = $this->getRequest()->getPost();
            echo "<pre>";
            print_r($attributeData);
        }

       
    }
?>