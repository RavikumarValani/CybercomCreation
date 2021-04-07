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

        public function formAction()
        {
            try 
            {
                $edit = \Mage::getBlock('Admin\Config\Edit\Tabs\Form');
                $editHtml = $edit->toHtml();
                $leftBar = \Mage::getBlock('Admin\Config\Edit\Tabs')->toHtml(); 

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

                $configId = $this->getRequest()->getGet('configId');
                $config = \Mage::getModel('Config');
                if($configId)
                {
                    $configData = $config->load($configId);
                    if(!$configData)
                    {
                        $this->getMessage()->setFailure('Data not found.');
                    }
                }
                
                $edit->setTableRow($config);
                
            }catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            
        }

        function saveAction()
        {
            
            try 
            {
                $configData = $this->getRequest()->getPost('config');
                print_r($configData);
                
                $configId = $this->getRequest()->getGet('configId');
                $config = \Mage::getModel('Config');
                if($configId)
                {
                    $config->load($configId);
                    $config->updateddate = date("Y-m-d H:i:s");
                }
                $config->setData($configData);
                $config->createddate = date("Y-m-d H:i:s");
                $config->save();
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->redirect('grid',null,null,true);
        }

        public function deleteAction()
        {
            try 
            {
                $configId = $this->getRequest()->getGet('configId');
                $config = \Mage::getModel('config');
                if(!$configId)
                {
                    $this->setMessage('Id Not Found');
                }
                $config->delete($configId);

            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->redirect('grid');
        }
    }
    

?>