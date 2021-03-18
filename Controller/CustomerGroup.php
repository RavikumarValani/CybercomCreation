<?php

    Mage::loadFileByClassName('Controller_Core_Admin');

    class Controller_CustomerGroup extends Controller_Core_Admin
    {

        public function formAction()
        {
            try 
            {
                $form = Mage::getBlock('Customer_GroupForm');

                $layout = $this->getLayout();

                $content = Mage::getBlock('Core_Layout_Content');
                $content = $layout->getChild('content');
                $content->addChild($form); 

                $left = $layout->getLeft();
            
                $leftSide = Mage::getBlock('Customer_Edit_Tabs');
                $left->addChild($leftSide);
                
                echo $this->tolayoutHtml();
            } catch (Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
        }

        public function saveAction()
        {
            try {
                $group_id = (int) $this->getRequest()->getGet('groupId');
                if(!$group_id)
                {
                    $this->setMessage('Id Not Found.');
                }
                $group = Mage::getModel('CustomerGroup');
                $groupData = $this->getRequest()->getPost('customerGroup');
                $group->setData($groupData);
                $group->save();

            } catch (Exception $e) {
                echo $e->getMessage();
            }
            $this->redirect('grid','customer');
        }
    }
    
?>