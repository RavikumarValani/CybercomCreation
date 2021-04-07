<?php
namespace Block\Admin\CMSPage;

    \Mage::loadFileByClassName("Block\Core\Template");

    class Grid extends \Block\Core\Template
    {
        protected $pageData = [];

        public function __construct()
        {
            $this->setTemplate('./view/admin/cmspage/grid.php');
        }
        public function setPageData()
        {
            $CMSPage = \Mage::getModel('CMSPage'); 
            $pageData = $CMSPage->fetchAll();
            
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