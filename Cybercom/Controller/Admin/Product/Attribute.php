<?php
namespace Controller\Admin\Product;

    \Mage::loadFileByClassName('Controller\Core\Admin');

    class Attribute extends  \Controller\Core\Admin
    {
        public function gridAction()
        {
            try 
            {
            
                $gridHtml = \Mage::getBlock('Admin\Product\Edit\Tabs\AttributeOption')->toHtml();
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
                    $this->getMessage()->setFailure('Unable To Process Request.');
                }

                $productAttribute = \Mage::getModel('Product\Attribute');

                $attributeData = $this->getRequest()->getPost('attribute');
                $productId = $this->getRequest()->getGet('productId');
               
                $productAttribute->attributeOptionId = $attributeData['attributeOptionId'];
                $productAttribute->productId = $productId;
                $productAttribute->save();
                

            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->gridAction();
        }

    }
?>