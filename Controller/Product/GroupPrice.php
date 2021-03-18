<?php 

    Mage::loadFileByClassName('Controller_Core_Admin');

    class Controller_Product_GroupPrice extends Controller_Core_Admin
    {
        public function indexAction()
        {
            try {

                $productId = (int)$this->getRequest()->getGet('id');
                $prduct = Mage::getModel('Product')->load($productId);
                if(!$prduct)
                {
                    throw new Exception("Record Not Found", 1);
                    
                }
                $layout = $this->getLayout();
                $groupPriceBlock = Mage::getBlock('Product_Edit_Tabs_GroupPrice')->setProduct($prduct);
                $content = $layout->getContent()->addChild($groupPriceBlock);
                $this->toLayoutHtml();
                
            } catch (Exception $e) {
                
            }
            
        }

        public function saveAction()
        {
            try {
                if($this->getRequest()->getPost())
                {
                    $this->setMessage('Request unable to process.');
                }
                $groupData = $this->getRequest()->getPost('groupPrice');
                $productId = $this->getRequest()->getGet('id');
                print_r($groupData);
                foreach ($groupData['exist'] as $groupId => $price) {
                    $query = "SELECT * FROM product_group_price 
                    WHERE productId = '{$productId}' 
                    AND customerGroupId = '{$groupId}'";
                    $groupPrice = Mage::getModel('Product_Group_Price');
                    $groupPrice->fetchRow($query);
                    $groupPrice->price = $price;
                    $groupPrice->save();

                }
                foreach ($groupData['new'] as $groupId => $price) {
                    $groupPrice = Mage::getModel('Product_Group_Price');
                    $groupPrice->customerGroupId = $groupId;
                    $groupPrice->productId = $productId;
                    $groupPrice->price = $price;
                    $groupPrice->save();

                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            // $this->redirect('index');
        }
    }
    
?>