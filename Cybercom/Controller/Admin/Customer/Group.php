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

                $layout = $this->getLayout();

                $layout->getContent()->addChild($edit);

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
                
                $this->tolayoutHtml();
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
        }

        public function gridAction()
        {
            try 
            {
                $layout = $this->getLayout();
                $grid = \Mage::getBlock('Admin\Customer\Group\Grid');
                $layout = $this->getLayout();

                $layout->getContent()->addChild($grid);

                $this->tolayoutHtml();
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
            $this->redirect('grid',null,null,true);
        }
    }
    
?>