<?php
namespace Controller\Admin;

    \Mage::loadFileByClassName("Controller\Core\Admin");

    class Category extends \Controller\Core\Admin
    {   
        public function gridAction()
        {
            try
            {
                $gridHtml = \Mage::getBlock('Admin\Category\Grid')->toHtml();
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
                $edit = \Mage::getBlock('Admin\Category\Edit');
                $editHtml = $edit->toHtml();
                $leftBar = \Mage::getBlock('Admin\Category\Edit\Tabs')->toHtml(); 

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

                $category = \Mage::getModel('Category');
                if($categoryId = (int) $this->getRequest()->getGet('categoryId'))
                {
                    $category->load($categoryId);
                    if(!$category)
                    {
                        $this->getMessage()->setFailure('Unable to Find Data.');   
                    }
                }
                $editHtml->setTableRow($category);

                $this->tolayoutHtml();
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
                    $this->getMessage()->setFailure('Unable To Process Request.');

                }
                $category = \Mage::getModel('Category');
                if($categoryId = (int) $this->getRequest()->getGet('categoryId'))
                {
                    $category->updateddate = date("Y-m-d H:i:s");
                    $category->load($categoryId);
                    if(!$category)
                    {
                        $this->getMessage()->setFailure('Unable to Find Data.');   
                    }
                }
                $category->createddate = date("Y-m-d H:i:s");

                $pathId = $category->pathId;
                $categoryData = $this->getRequest()->getPost('category');
                $category->setData($categoryData);
                $category->save();
                
                $category->updatePathId();
                $category->updateChildrenPathIds($pathId);
                

                $this->getMessage()->setSuccess('Record Save Successful.');
            }catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->redirect('grid',null,null,true);
        }
        public function deleteAction()
        {
            try 
            {
                $category = \Mage::getModel('Category');
                $categoryId = $this->getRequest()->getGet('categoryId');
                
                if(!$categoryId)
                {
                    $this->getMessage()->setFailure('Id Not Found.');
                }

                $category = $category->load($categoryId);
                if(!$category)
                {
                    $this->getMessage()->setFailure('Unable to Load Data.');
                }

                $pathId = $category->pathId;
                $parentId = $category->parentId;
                $category->updateChildrenPathIds($pathId, $parentId);

                if($category->delete($categoryId))
                {
                    $this->getMessage()->setSuccess('Record Delete Successful.');
                }
                else
                {
                    $this->getMessage()->setFailure('Unable To Delete Record.');
                }
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->redirect('grid',null,null,true);

        }

        public function statusAction()
        {
            try 
           {
               $categoryId = (int) $this->getRequest()->getGet('categoryId');
               if(!$categoryId)
                {
                    throw new \Exception("Id not found", 1);   
                }
                $category = \Mage::getModel('Category');
                $category->load($categoryId);
                if($category->status == 1)
                {
                    $category->status = 0;
                }
                else
                {
                    $category->status = 1;
                }
                $category->save();

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