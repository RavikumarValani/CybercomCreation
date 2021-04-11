<?php
namespace Controller\Admin;

    \Mage::loadFileByClassName('Controller\Core\Admin');

    class Admin extends \Controller\Core\Admin
    {
        
        public function gridAction()
        {
            try
            {
                $gridHtml = \Mage::getBlock('Admin\Admin\Grid')->toHtml();
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
                $formHtml = \Mage::getBlock('Admin\Admin\Edit\Tabs\Form')->toHtml();
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
                    $this->getMessage()->setFailure('Unable to Process Request.');
                }
                $admin = \Mage::getController('Model\Admin');
                if($id = (int) $this->getRequest()->getGet('id'))
                {
                    $admin->load($id);
                    if(!$admin)
                    {
                        $this->getMessage()->setFailure('Unable to Process Data.');
                    }
                }
            
                $adminData = $this->getRequest()->getPost('admin');
                $admin->createddate = date("Y-m-d H:i:s");
                $admin->setData($adminData);
                $admin->save();
                
            }catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->gridAction();
        }
        public function deleteAction()
        {
            try 
            {
                $adminId = $this->getRequest()->getGet('adminId');
                if(!$adminId)
                {
                    $this->getMessage()->setFailure("Id not found.");
                }
                $admin = \Mage::getModel('Admin');
                $admin->load($adminId);
                if(!$admin)
                {
                    $this->getMessage()->setFailure("Data not found.");
                }
                $admin->delete($adminId);
                
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->gridAction();
        }

        public function statusAction()
        {
            try 
           {
               $id = (int) $this->getRequest()->getGet('adminId');
               if(!$id)
                {
                    throw new \Exception("Id not found", 1);   
                }
                $admin = \Mage::getModel('Admin');
                $admin->load($id);
                if($admin->status == 1)
                {
                    $admin->status = 0;
                }
                else
                {
                    $admin->status = 1;
                }
                $admin->save();
                $gridHtml = \Mage::getBlock('Admin\Grid')->toHtml();
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