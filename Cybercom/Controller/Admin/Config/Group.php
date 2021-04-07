<?php 
namespace Controller\Admin\Config;

    \Mage::loadFileByClassName('Controller\Core\Admin');

    class Group extends  \Controller\Core\Admin
    {
        public function gridAction()
        {
            $grid = \Mage::getBlock('Admin\Config\Group\Grid');
            $config = \Mage::getModel('Config');
            $configId = $this->getRequest()->getGet('configId');
            $config->load($configId);
            $grid->setConfig($config);

            $layout = $this->getLayout();

            $layout->getContent()->addChild($grid);

            $this->toLayoutHtml();
        }

        public function updateAction()
        {
            
            try 
            {
                $groupData = $this->getRequest()->getPost();

                $configId = $this->getRequest()->getGet('configId');
                $config = \Mage::getModel('Config');
                $query = "SELECT groupId FROM `config` WHERE `configId` = '{$configId}' ";
                $groupId = $config->fetchRow($query)->groupId;

                if(array_key_exists('exit', $groupData))
                {
                    foreach ($groupData['exist'] as $key => $value) {
                        $groupModel = \Mage::getModel('config\group');
                        $query = "SELECT * FROM `config_group` 
                        WHERE groupId = '{$groupId}'";
                        $groupModel->fetchRow($query);
                        $groupModel->name = $value['name'];
                        $groupModel->save();
        
                    }
                }
                if(array_key_exists('new', $groupData))
                {
                    foreach ($groupData['new'] as $key => $value) {
                        foreach($value as $key2 =>$data)
                        {
                            $newData[$key2][$key] = $data;    
                        }
                    }
                    foreach ($newData as $key => $value) {
                        $groupModel = \Mage::getModel('Config\Group');
                        $groupModel->groupId = $groupId;
                        $groupModel->createddate = date("Y-m-d H:i:s");
                        $groupModel->setData($value);
                        $groupModel->save();
                    }
                }
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }

            $this->redirect('grid');
        }
    }
    
?>