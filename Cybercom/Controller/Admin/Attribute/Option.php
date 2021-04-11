<?php 
namespace Controller\Admin\Attribute;

    \Mage::loadFileByClassName('Controller\Core\Admin');
    class Option extends \Controller\Core\Admin
    {
        public function gridAction()
        {
            try 
            {
                $attribute = \Mage::getModel('Attribute');
                $attributeId = $this->getRequest()->getGet('attributeId');
                $attribute = $attribute->load($attributeId);

                $gridBlock = \Mage::getBlock('Admin\Attribute\Option\Grid');
                $gridBlock->setAttribute($attribute);
                
                $gridHtml = $gridBlock->toHtml();
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
            try 
           {
               if(!$this->getRequest()->isPost())
               {
                   $this->getMessage()->setFailure('Unable to process request.');
               }
                $optionData = $this->getRequest()->getPost();
                
                $attributeId = $this->getRequest()->getGet('attributeId');

                if(array_key_exists('exist', $optionData))
                {
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
                }
                
                if (array_key_exists('new', $optionData)) {
                    foreach ($optionData['new'] as $key => $value) {
                        foreach ($value as $key2 =>$data) {
                            $newData[$key2][$key] = $data;
                        }
                    }
                    foreach ($newData as $key => $value) {
                        $optionModel = \Mage::getModel('Attribute\Option');
                        $optionModel->attributeId = $attributeId;
                        $optionModel->setData($value);
                        $optionModel->save();
                    }
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
                $optionId = (int)$this->getRequest()->getGet('optionId');
                if(!$optionId)
                {
                    throw new \Exception("Error Processing Request");
                }
                $AttributeOption = \Mage::getModel('Attribute\Option');
                $AttributeOption->delete($optionId);
                
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->gridAction();
        }
    }
    
?>