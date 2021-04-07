<?php 
namespace Controller\Admin;

    \Mage::loadFileByClassName('Controller\Core\Admin');

    class Attribute extends \Controller\Core\Admin
    {
        public function gridAction()
        {
            try 
           {
                $gridHtml = \Mage::getBlock('Admin\Attribute\Grid')->toHtml();
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
                $edit = \Mage::getBlock('Admin\Attribute\Edit\Tabs\Form');
                $editHtml = $edit->toHtml();
                $response = [
                    'element' => [
                        'selector' => '#contentHtml',
                        'html' => $editHtml
                    ]
                ];
                header("Content-Type: application/json");
                echo json_encode($response);

                $attribute = \Mage::getModel('attribute');

                $attributeId = (int) $this->getRequest()->getGet('attributeId');
                if($attributeId)
                {
                    $attribute->load($attributeId);
                    if(!$attribute)
                    {
                        throw new \Exception("Data not found.");
                        
                    }
                }
                $edit->setTableRow($attribute);
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
        }

        
        public function saveAction()
        {
           try 
           {
                if (!$this->getRequest()->isPost()) 
                {
                    $this->getMessage()->setFailure('Unable To Process Request.');
                }
                $attribute = \Mage::getModel('Attribute');
                if($attributeId = (int)$this->getRequest()->getGet('attributeId'))
                {
                    $attribute = $attribute->load($attributeId);
                } 
                $attributeData = $this->getRequest()->getPost('attribute');
                $attribute->setData($attributeData);
                $attribute->backEndModel = 'attribute_option';

                $attribute->save();
            
                $this->getMessage()->setSuccess('Record Save Successful.');
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->redirect('grid');
        }

        public function optionsAction()
        {
            try 
            {
                $attribute = \Mage::getModel('Attribute');
                $attributeId = $this->getRequest()->getGet('attributeId');
                $attribute = $attribute->load($attributeId);

                $layout = $this->getLayout();

                $gridBlock = \Mage::getBlock('Admin\Attribute\Option\Grid');
                $gridBlock->setAttribute($attribute);
                $layout->getContent()->addChild($gridBlock);

                $this->toLayoutHtml();

            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }

        }

        public function updateAction()
        {
            try 
           {
                $optionData = $this->getRequest()->getPost();
                
                $attributeId = $this->getRequest()->getGet('attributeId');

                foreach ($optionData['exist'] as $key => $value) {
                    $optionModel = \Mage::getModel('Attribute\Option');
                    $query = "SELECT * FROM `attribute_option` 
                    WHERE attributeId = '{$attributeId}'
                    AND optionId = '{$key}'";
                    $optionModel->fetchRow($query);
                    $optionModel->name = $value['name'];
                    $optionModel->sortOrder = $value['sortOrder'];
                    $optionModel->save();

                }
                
                foreach ($optionData['new'] as $key => $value) {
                    foreach($value as $key2 =>$data)
                    {
                        $newData[$key2][$key] = $data;    
                    }
                }
                foreach ($newData as $key => $value) {
                    $optionModel = \Mage::getModel('Attribute\Option');
                    $optionModel->attributeId = $attributeId;
                    $optionModel->setData($value);
                    $optionModel->save();
                }

            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            
            $this->redirect('grid');
        }

        public function deleteAction()
        {
            try 
            {
                $attributeId = $this->getRequest()->getGet('attributeId');
                $attribute = \Mage::getModel('Attribute');
                if(!$attributeId)
                {
                    $this->setMessage('Id Not Found');
                }
                $attribute->delete($attributeId);

            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->redirect('grid');
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