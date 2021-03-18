<?php
    Mage::loadFileByClassName('Controller_Core_Admin');
    class Controller_Index extends  Controller_Core_Admin
    {
        public function indexAction()
        {
            $layout = $this->getLayout();
            $content = $layout->getChild('content');
            $dashboard = Mage::getBlock('Index_Index');
            $content->addChild($dashboard);
            $this->toLayoutHtml();
        }
    }
    
?>