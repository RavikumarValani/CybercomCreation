<?php
    Mage::loadFileByClassName('Controller_Core_Admin');
    class Controller_Admin extends Controller_Core_Admin
    {
        
        public function gridAction()
        {
            try
            {
                $layout = Mage::getBlock('Core_Layout');
                $grid = Mage::getBlock('Admin_Grid');
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
                $form = Mage::getBlock('Admin_Edit');
                $layout = $this->getLayout();

                $content = Mage::getBlock('Core_Layout_Content');
                $content = $layout->getContent();
                $content->addChild($form);

                echo $this->tolayoutHtml();
            } catch (Exception $e) {
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
                $admin = Mage::getController('Model_Admin');
                if($id = (int) $this->getRequest()->getGet('id'))
                {
                    $admin->load($id);
                    if(!$admin)
                    {
                        $this->getMessage()->setFailure('Unable to Process Data.');
                    }
                }
            
                $adminData = $this->getRequest()->getPost('admin');
                $admin->setData($adminData);
                $admin->save();
                $this->getMessage()->setSuccess('Record Save Successful.');
            }catch (Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->redirect('grid',null,null,true);
        }
        public function deleteAction()
        {
            try 
            {
                if($this->getRequest()->isPost())
                {
                    $this->getMessage()->setFailure('Unable To Delete Record.');
                }
                $id = $this->getRequest()->getGet('id');
                $admin = Mage::getController('Model_Admin');
                if ($admin->delete($id)) {
                    $this->getMessage()->setSuccess('Record Delete Successful.');
                }
                else
                {
                    $this->getMessage()->setFailure('Unable to Delete Record.');
                }
            } catch (Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->redirect('grid');
        }
        public function statusAction()
        {
            try {
                if ($this->getRequest()->isPost()) {
                    throw new Exception("Error Processing Request", 1);
                }
                $id = (int) $this->getRequest()->getGet('id');
                $status = (int) $this->getRequest()->getGet('status');
                if (!$id) {
                    throw new Exception("Data not found", 1);
                }
                if (!($status == 0) && !($status == 1)) {
                    throw new Exception("Error Processing Request", 1);
                }
                if ($status == 0) {
                    $query = "UPDATE `admin` SET `status`=1 WHERE `id` = {$id}";
                    $adapter = Mage::getModel('Core_Adapter');
                    $adapter->update($query);
                }
                if ($status == 1) {
                    $query = "UPDATE `admin` SET `status`=0 WHERE `id` = {$id}";
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