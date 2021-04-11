<?php 
namespace Controller\Admin\Config;

    \Mage::loadFileByClassName('Controller\Core\Admin');

    class Group extends  \Controller\Core\Admin
    {
        public function gridAction()
        {
            try 
           {
                $gridHtml = \Mage::getBlock('Admin\Config\Group\Grid')->toHtml();
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
                $edit = \Mage::getBlock('Admin\Config\Group\Edit');
                $configGroup = \Mage::getModel('Config\Group');

                $groupId = (int) $this->getRequest()->getGet('groupId');

                if($groupId)
                {
                    $configGroup->load($groupId);
                    if(!$configGroup)
                    {
                        throw new \Exception("Data not found.");
                        
                    }
                }
                $edit->setTableRow($configGroup);

                $editHtml = $edit->toHtml();
                $leftBar = \Mage::getBlock('Admin\Config\Group\Edit\Tabs')->toHtml();
                $response = [
                    'element' => [
                        'selector' => '#contentHtml',
                        'html' => $editHtml
                    ],
                    [
                        'selector' => '#tabContent',
                        'html' => $leftBar
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
                if(!$this->getRequest()->isPost())
                {
                    throw new \Exception("Invalid request.");
                    
                }
                $groupData = $this->getRequest()->getPost('configGroup');
                $groupId = $this->getRequest()->getGet('groupId');

                $configGroup = \Mage::getModel('Config\Group');
                if($groupId)
                {
                    $configGroup->load($groupId);
                }
                $configGroup->name = $groupData['name'];
                $configGroup->createddate = date("Y-m-d H:i:s");
                $configGroup->save();

                
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->gridAction();

        }

        public function deleteAction()
        {
            try 
            {
                $groupId = $this->getRequest()->getGet('groupId');
                $configGroup = \Mage::getModel('Config\Group');
                if(!$groupId)
                {
                    $this->getMessage()->setFailure('Id Not Found');
                }
                $configGroup->load($groupId);
                if(!$configGroup)
                {
                    $this->getMessage()->setFailure('Data Not Found');
                }
                $configGroup->delete($groupId);
                
                $gridHtml = \Mage::getBlock('Admin\Config\Group\Grid')->toHtml();
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
            $this->gridAction();
        }
    }
    
?>