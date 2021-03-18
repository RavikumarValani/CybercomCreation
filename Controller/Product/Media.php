<?php
    Mage::loadFileByClassName('Controller_Core_Admin');
    class Controller_Product_Media extends  Controller_Core_Admin
    {
        public function indexAction()
        {
            $layout = $this->getLayout();
            $this->toLayoutHtml();
        }
    }
    
