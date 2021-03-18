<?php 

    // save action not completed
    Mage::loadFileByClassName('Controller_Core_Admin');
    class Controller_Attribute extends Controller_Core_Admin
    {
        public function gridAction()
        {
            try 
           {
                $gridBlock = Mage::getBlock('Attribute_Grid');

                $layout = $this->getLayout();

                $content = $layout->getContent();
                $content->addChild($gridBlock);
                $this->toLayoutHtml();
            } catch (Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
        }

        public function formAction()
        {
            try 
           {
                $layout = $this->getLayout();

                $editBlock = Mage::getBlock('Attribute_Edit');
                $layout->getContent()->addChild($editBlock);

                $this->toLayoutHtml();
            } catch (Exception $e) {
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
                $attribute = Mage::getModel('Attribute'); 
                $attributeData = $this->getRequest()->getPost('attribute');
                $attribute->setData($attributeData);
                $attribute->save();
                $this->getMessage()->setSuccess('Record Save Successful.');
            } catch (Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->redirect('grid');
        }

        public function optionsAction()
        {
            $attribute = Mage::getModel('Attribute');
            $attributeId = $this->getRequest()->getGet('attributeId');
            $attribute = $attribute->load($attributeId);

            $layout = $this->getLayout();

            $gridBlock = Mage::getBlock('Attribute_Option_Grid');
            $gridBlock->setAttribute($attribute);
            $layout->getContent()->addChild($gridBlock);

            $this->toLayoutHtml();

        }

        public function updateAction()
        {
            echo "<pre>";
            $optionData = $this->getRequest()->getPost();
            $attributeId = $this->getRequest()->getGet('attributeId');

            foreach ($optionData['exist'] as $key => $value) {
                $optionModel = Mage::getModel('Attribute_Option');
                $query = "SELECT * FROM attribute_option 
                WHERE attributeId = '{$attributeId}'
                AND optionId = '{$key}'";
                $optionModel->fetchRow($query);
                $optionModel->name = $value['name'];
                $optionModel->sortOrder = $value['sortOrder'];
                $optionModel->save();

            }
            foreach ($optionData['new'] as $key => $value) {
                $optionModel = Mage::getModel('Attribute_Option');
                $optionModel->$key = $value[0];
                $optionModel->attributeId = $attributeId;
                print_r($optionData);
                $optionModel->save();
            }
            // $this->redirect('grid');
        }

        public function deleteAction()
        {
            $attributeId = $this->getRequest()->getGet('attributeId');
            $attribute = Mage::getModel('Attribute');
            if(!$attributeId)
            {
                $this->setMessage('Id Not Found');
            }
        }

    }
    
?>