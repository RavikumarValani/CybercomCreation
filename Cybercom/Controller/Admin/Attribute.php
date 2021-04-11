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
                
                $editHtml = $edit->toHtml();
                $response = [
                    'element' => [
                        'selector' => '#contentHtml',
                        'html' => $editHtml
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
            $this->gridAction();
        }

        public function deleteAction()
        {
            try 
            {
                $attributeId = $this->getRequest()->getGet('attributeId');
                $attribute = \Mage::getModel('Attribute');
                if(!$attributeId)
                {
                    $this->getMessage()->setFailure('Id Not Found');
                }
                $attribute->load($attributeId);
                if(!$attribute)
                {
                    $this->getMessage()->setFailure('Data Not Found');
                }
                $attribute->delete($attributeId);
                

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