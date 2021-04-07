<?php
namespace Controller\Admin;

    \Mage::loadFileByClassName("Controller\Core\Admin");

    class CMSPage extends \Controller\Core\Admin 
    {
        public function gridAction()
        {
            try 
            {
                $gridHtml = \Mage::getBlock('Admin\CMSPage\Grid')->toHtml();
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
                $edit = \Mage::getBlock('Admin\CMSPage\Edit');
                $editHtml = $edit->toHtml();
                $response = [
                    'element' => [
                        'selector' => '#contentHtml',
                        'html' => $editHtml
                    ]
                ];
                header("Content-Type: application/json");
                echo json_encode($response);

                $CMSPage = \Mage::getModel('CMSPage');
                if($pageId = (int) $this->getRequest()->getGet('pageID'))
                {
                    $CMSPage->load($pageId);
                    if(!$CMSPage)
                    {
                        $this->getMessage()->setFailure('Unable to Find Data.');   
                    }
                }
                $edit->setTableRow($CMSPage);
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
                $CMSPage = \Mage::getModel('CMSPage'); 
                if($pageId = (int) $this->getRequest()->getGet('pageId'))
                {
                    $CMSPage->load($pageId);
                    if(!$CMSPage)
                    {
                        $this->getMessage()->setFailure('Unable to Find Data.');   
                    }
                }
                $pageData = $this->getRequest()->getPost('pageData');
                $CMSPage->setData($pageData);
                $CMSPage->save();
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
               $pageId = $this->getRequest()->getGet('pageId');
               if(!$pageId)
               {
                    $this->getMessage()->setFailure('Id Not Found.');
               }
               $CMSPage = \Mage::getModel('CMSPage');
               if($CMSPage->delete($pageId))
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
               $pageId = (int) $this->getRequest()->getGet('pageId');
               if(!$pageId)
                {
                    throw new \Exception("Id not found", 1);   
                }
                $CMSPage = \Mage::getModel('CMSPage');
                $CMSPage->load($pageId);
                if($CMSPage->status == 1)
                {
                    $CMSPage->status = 0;
                }
                else
                {
                    $CMSPage->status = 1;
                }
                $CMSPage->save();

           } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
           }
           $this->redirect('grid', null, null, true);
        }
    }
?>