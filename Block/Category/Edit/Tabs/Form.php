<?php
    Mage::loadFileByClassName('Block_Core_Template');
    class Block_Category_Edit_Tabs_Form extends  Block_Core_Template
    {
        protected $category = null;

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/category/edit/tabs/form.php');
        }

        public function setCategory($category = null)
        {
            if($category){
                $this->category = $category;
                return $this;
            }
            $category = Mage::getModel('Category');
            $this->setTitle("Add Category");
            if ($categoryId = (int) $this->getRequest()->getGet('categoryId')) {
                $category->load($categoryId);
                $this->setTitle("Update Category");
            }
            if(!$category){
                $category = Mage::getModel('Category');
            }
            $this->category = $category;
            return $this;
        }
        public function getCategory()
        {
            if(!$this->category){
                $this->setCategory();
            }
            return $this->category;
        }

        public function getParentOptions()
        {
            $categories = Mage::getModel('Category');
            $query = "SELECT name,categoryId FROM category";
            return $categories->fetchAll($query);
        }
    }
    
?>