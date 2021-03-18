<?php
    //not delete completed

    Mage::loadFileByClassName("Controller_Core_Admin");

    class Controller_Category extends Controller_Core_Admin
    {   
        public function gridAction()
        {
            try
            {
                $grid = Mage::getBlock('Category_Grid');
                $layout = $this->getLayout();

                $content = Mage::getBlock('Core_Layout_Content');
                $content = $layout->getContent()->addChild($grid);

                $this->tolayoutHtml();
            } catch (Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());         
            }
        }

        public function formAction()
        {
            try
            {
                $EditBlock = Mage::getBlock('Category_Edit');
                $leftBar = Mage::getBlock('Category_Edit_Tabs'); 

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
                    $this->getMessage()->setFailure('Unable To Process Request.');

                }
                $category = Mage::getModel('Category');
                if($categoryId = (int) $this->getRequest()->getGet('categoryId'))
                {
                    $category->load($categoryId);
                    if(!$category)
                    {
                        $this->getMessage()->setFailure('Unable to Find Data.');   
                    }
                }
                $categoryData = $this->getRequest()->getPost('category');
                $category->setData($categoryData);
                $category->save();

                if($category->parentId)
                {
                    $parent = Mage::getModel('Category')->load($category->parentId);
                    if($parent->pathId)
                    {
                        $category->pathId = $parent->pathId."=".$category->categoryId;
                        
                    }
                }
                else
                { 
                    $category->pathId = $category->categoryId;
                }
                
                $category->save();

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
                $categoryId = $this->getRequest()->getGet('categoryId');
                $category = Mage::getModel('Category');
                $category->delete($categoryId);
                if($category->delete($categoryId))
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
            $this->redirect('grid',null,null,true);

        }
        public function statusAction()
        {
            try {
                $categoryId = (int) $this->getRequest()->getGet('categoryId');
                $status = (int) $this->getRequest()->getGet('status');
                if (!$categoryId) {
                    throw new Exception("Data not found", 1);
                }
                if (!($status == 0) && !($status == 1)) {
                    $this->getMessage()->setFailure('Unable To Processs Request.');
                }
                if ($status == 0) {
                    $query = "UPDATE `category` SET `status`=1 WHERE `categoryId` = {$categoryId}";
                    $adapter = Mage::getModel('Core_Adapter');
                    $adapter->update($query);
                }
                if ($status == 1) {
                    $query = "UPDATE `category` SET `status`=0 WHERE `categoryId` = {$categoryId}";
                    $adapter = Mage::getModel('Core_Adapter');
                    $adapter->update($query);
                }
            } catch (Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->redirect('grid',null,null,true);
        }
    }
?>