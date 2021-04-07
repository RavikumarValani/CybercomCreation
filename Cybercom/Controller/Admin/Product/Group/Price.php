<?php 
namespace Controller\Admin\Product\Group;

    \Mage::loadFileByClassName('Controller\Core\Admin');

    class Price extends \Controller\Core\Admin
    {
        public function indexAction()
        {
            try {

                $productId = (int)$this->getRequest()->getGet('productId');
                $prduct = \Mage::getModel('Product')->load($productId);
                if(!$prduct)
                {
                    throw new \Exception("Record Not Found", 1);
                    
                }
                $layout = $this->getLayout();
                $groupPriceBlock = \Mage::getBlock('Admin\Product\Edit\Tabs\Group\Price')->setProduct($prduct);
                $content = $layout->getContent()->addChild($groupPriceBlock);
                $this->toLayoutHtml();
                
            } catch (\Exception $e) {
                $this->getMessage()->setFailure();
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
                $productId = $this->getRequest()->getGet('productId');
                if(array_key_exists('exist', $groupData))
                {
                    foreach ($groupData['exist'] as $groupId => $price) {
                        $query = "SELECT * FROM product_group_price 
                        WHERE productId = '{$productId}' 
                        AND customerGroupId = '{$groupId}'";
                        $groupPrice = \Mage::getModel('Product\Group\Price');
                        $groupPrice->fetchRow($query);
                        $groupPrice->price = $price;
                        $groupPrice->save();
    
                    }
                }
                if(array_key_exists('new', $groupData))
                {
                    foreach ($groupData['new'] as $groupId => $price) {
                        $groupPrice = \Mage::getModel('Product\Group\Price');
                        $groupPrice->customerGroupId = $groupId;
                        $groupPrice->productId = $productId;
                        if(!$price)
                        {
                            continue;
                        }
                        $groupPrice->price = $price;
                        $groupPrice->save();

                    }
                }
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
            $this->redirect('index');
        }
    }
    
?>