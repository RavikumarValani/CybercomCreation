<?php

    Mage::loadFileByClassName("Controller_Core_Admin");

    class Controller_Product extends Controller_Core_Admin 
    {
        public function gridAction()
        {
            try 
            {
                $grid = Mage::getBlock('Product_Grid');
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
                $EditBlock = Mage::getBlock('Product_Edit');
                $leftBar = Mage::getBlock('Product_Edit_Tabs'); 

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
                $product = Mage::getModel('Product'); 
                if($id = (int) $this->getRequest()->getGet('id'))
                {
                    $product->load($id);
                    if(!$product)
                    {
                        $this->getMessage()->setFailure('Unable to Find Data.');   
                    }
                }
                $productData = $this->getRequest()->getPost('product');
                $product->setData($productData);
                $product->save();
                $this->getMessage()->setSuccess('Record Successfully Save.');
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
               if(!$id)
               {
                    $this->getMessage()->setFailure('Id Not Found.');
               }
               $product = Mage::getModel('Product');
               if($product->delete($id))
               {
                    $this->getMessage()->setSuccess('Record Successful Deleted.');
               }
               else{
                    $this->getMessage()->setFailure('Unable to Delete Record');
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
                    throw new Exception("Data not found", 1);   
                }
               if(!($status == 0) && !($status == 1))
               {
                    throw new Exception("Error Processing Request", 1);       
               }
               if($status == 0)
               {
                   $query = "UPDATE `product` SET `status`=1 WHERE `id` = {$id}";
                   $adapter = Mage::getModel('Core_Adapter');
                   $adapter->update($query);
               }
               if($status == 1)
               {
                   $query = "UPDATE `product` SET `status`=0 WHERE `id` = {$id}";
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