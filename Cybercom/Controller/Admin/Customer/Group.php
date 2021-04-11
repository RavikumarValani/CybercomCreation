<?php
namespace Controller\Admin\Customer;

    \Mage::loadFileByClassName('Controller\Core\Admin');

    class Group extends \Controller\Core\Admin
    {

        public function formAction()
        {
            try 
            {
                $edit = \Mage::getBlock('Admin\Customer\Group\Edit');
                $group = \Mage::getModel('Customer\Group');
                if($groupId = (int) $this->getRequest()->getGet('groupId'))
                {
                    $group->load($groupId);
                    if(!$group)
                    {
                        $this->getMessage()->setFailure('Unable to Find Data.');   
                    }
                }
                
                
                $edit->setTableRow($group);

                $editHtml = $edit->toHtml();
                $leftBar = \Mage::getBlock('Admin\Customer\Edit\Tabs')->toHtml(); 

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
        }

        public function gridAction()
        {
            try 
            {
                $gridHtml = \Mage::getBlock('Admin\Customer\Group\Grid')->toHtml();
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

        public function saveAction()
        {
            try {
                $groupId = (int) $this->getRequest()->getGet('groupId');
                if(!$groupId)
                {
                    $this->setMessage('Id Not Found.');
                }
                $group = \Mage::getModel('Customer\Group');
                $groupData = $this->getRequest()->getPost('customerGroup');
                $group->createddate = date("Y-m-d H:i:s");
                $group->setData($groupData);
                $group->save();

            } catch (\Exception $e) {
                echo $e->getMessage();
            }
            $this->gridAction();
        }

        public function deleteAction()
        {
            try 
            {
                $groupId = $this->getRequest()->getGet('groupId');
                $group = \Mage::getModel('Customer\Group');
                if(!$groupId)
                {
                    $this->getMessage()->setFailure('Id not found.');
                }
                $group->load($groupId);
                if(!$group)
                {
                    $this->getMessage()->setFailure('Data not found.');
                }
                $group->delete($groupId);
               
                
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