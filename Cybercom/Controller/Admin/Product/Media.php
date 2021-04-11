<?php
namespace Controller\Admin\Product;

    \Mage::loadFileByClassName('Controller\Core\Admin');

    class Media extends  \Controller\Core\Admin
    {
        protected $images = [];

        public function setImages($images)
        {
            $this->images =$images;
            return $this;
        }
        public function getImages()
        {
            return $this->images;
        }

        public function gridAction()
        {
            try 
            {
            
                $gridHtml = \Mage::getBlock('Admin\Product\Edit\Tabs\Media')->toHtml();
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

                $editHtml = \Mage::getBlock('Admin\Product\Edit\Tabs\Media')->toHtml();
                $leftBar = \Mage::getBlock('Admin\Product\Edit\Tabs')->toHtml(); 

                $response = [
                    'status' => 'success',
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

            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            } 
        }

        public function uploadAction()
        {
            try 
            {
                if(!$this->getRequest()->isPost())
                {
                    $this->getMessage()->setFailure('Unable To Process Request.');
                }

                $productImage = $this->getRequest()->getFiles('image');
                $productId = $this->getRequest()->getGet('productId');

                if(!$productId)
                {
                    $this->getMessage()->setFailure('Id Not Found.');
                }

                $productMedia = \Mage::getModel('Product\Media');
                
                $filename = $productImage['name'];
                $filetmp = $productImage['tmp_name'];
                $imagePath = $productMedia->getImagePath()."{$filename}";
                
                move_uploaded_file($filetmp, $imagePath);
                
                $productMedia->Image = $filename;
                $productMedia->productId = $productId;

                if($productMedia->save())
                {
                    $this->getMessage()->setSuccess('Image Upload Successfully');
                }
                else
                {
                    $this->getMessage()->setFailure('Unable To Upload Image');
                }
                
            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->gridAction();
        }
        public function updateAction()
        {
            try 
            {
                if(!$this->getRequest()->isPost())
                {
                    $this->getMessage()->setFailure('Unable To Process Request.');
                }

                $product = \Mage::getModel('Product');
                $productMedia = \Mage::getModel('Product\Media');

                $productId = $this->getRequest()->getGet('productId');
                $imageData = $this->getRequest()->getPost('image');

                if($productId)
                {
                    $product = $product->load($productId);
                    if(!$product)
                    {
                        $this->getMessage()->setFailure('Unable To Load Data.');
                    }
                }

                $imageData['data'] = array_filter(array_map(function ($value){
                    return array_filter($value);
                }, $imageData['data']));
                foreach ($imageData as $key => $value) 
                {
                    if($key == 'data')
                    {
                        foreach ($value as $imageId => $value) {
                            $productMedia->load($imageId);
                            $productMedia->gallary = 1;
                            $productMedia->save();
                        }
                    }

                    if($key == 'small' || $key == 'base' || $key == 'thumb')
                    {
                        $productMedia->load($value);
                        $productMedia->$key = 1;
                        $productMedia->save();
                    }  

                    if($key == 'remove')
                    {
                        foreach($imageData['remove'] as $imageId => $value)
                        {
                            $productMedia = $productMedia->load($imageId);
                            $productMedia->delete($imageId);
                        }
                    }

                    if($value == null)
                    {
                        $this->getMessage()->setFailure('Please select any one field.');
                    }
                }
                

            } catch (\Exception $e) {
                $this->getMessage()->setFailure($e->getMessage());
            }
            $this->gridAction();
        }

    }
?>