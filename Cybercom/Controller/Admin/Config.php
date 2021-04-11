<?php 
namespace Controller\Admin;

    \Mage::getController('Controller\Core\Admin');

    class Config extends \Controller\Core\Admin 
    {
        
        public function gridAction()
        {
            try
            {
                $gridHtml = \Mage::getBlock('Admin\Config\Grid')->toHtml();
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

        

        function saveAction()
        {
            
            try 
            {
                $configData = $this->getRequest()->getPost();
                
                $groupId = $this->getRequest()->getGet('groupId');

                foreach ($configData['exist'] as $key => $value) {
                    $config = \Mage::getModel('Config');
                    $query = "SELECT * FROM `{$config->getTableName()}` 
                    WHERE groupId = '{$groupId}'";
                    $config->fetchRow($query);
                    $config->name = $value['title'];
                    $config->name = $value['code'];
                    $config->name = $value['value'];
                    $config->save();

                }
                
                foreach ($configData['new'] as $key => $value) {
                    foreach($value as $key2 =>$data)
                    {
                        $newData[$key2][$key] = $data;    
                    }
                }
                foreach ($newData as $key => $value) {
                    $config = \Mage::getModel('Config');
                    $config->groupId = $groupId;
                    $config->setData($value);
                    $config->createddate = date("Y-m-d H:i:s");
                    $config->save();
                }
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->gridAction();
        }

        public function deleteAction()
        {
            try 
            {
                $configId = $this->getRequest()->getGet('configId');
       
                $config = \Mage::getModel('config');

                if(!$configId)
                {
                    $this->getMessage()->setFailure('Id Not Found');
                }
                $config->delete($configId);

            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->gridAction();
        }
    }
    

?>