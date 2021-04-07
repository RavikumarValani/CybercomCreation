<?php
namespace Block\Admin\CMSPage;

    \Mage::loadFileByClassName("Block\Core\Template");

    class Edit extends \Block\Core\Template 
    {
        protected $pageData = null;

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/admin/cmspage/edit.php');
        }

        public function setPageData()
        {
            $pageData = \Mage::getModel('CMSPage');
            $this->setTitle("Add Page");
            if ($pageId = (int) $this->getRequest()->getGet('pageId')) {
                $pageData->load($pageId);
                $this->setTitle("Update Page");
            }
            if(!$pageData){
                $pageData = \Mage::getModel('Admin');
            }
            
            $this->pageData = $pageData;
            return $this;
        }
        public function getPageData()
        {
            if(!$this->pageData){
                $this->setPageData();
            }
            return $this->pageData;
        }

    }
    
?>