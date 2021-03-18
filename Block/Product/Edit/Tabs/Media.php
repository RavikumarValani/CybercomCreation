<?php
    Mage::loadFileByClassName('Block_Core_Template');
    class Block_Product_Edit_Tabs_Media extends  Block_Core_Template
    {
        protected $image = null;
        protected $images = [];

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/product/edit/tabs/media.php');
        }

        public function setImages($images = null)
        {
            if(!$images)
            {
                $images = Mage::getModel('ProductImage');
                $this->images = $images->fetchAll();
            }
            $this->images = $images;
            return $this;
        }
        public function getImages()
        {
            if(!$this->images)
            {
                $this->setImages();
            }
            return $this->images;
        }

        public function setImage($image = null)
        {
            if(!$image)
            {
                $image = Mage::getModel('ProductImage');
                $this->image = $image->fetchAll();
            }
            $this->image = $image;
            return $this;
        }
        public function getImage()
        {
            if(!$this->image)
            {
                $this->setImage();
            }
            return $this->image;
        }


    }
    
?>