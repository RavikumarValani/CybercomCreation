<?php
namespace Block\Admin\Category;

    \Mage::loadFileByClassName("Block\Core\Grid");
    
    class Grid extends \Block\Core\Grid  
    {
        protected $category = [];
        protected $categoriesOptions = [];
        
        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/admin/category/grid.php');
        }   


        public function setCategories($category = null)
        {
            if(!$category){
                $category = \Mage::getModel('Category');
                $query = "SELECT * FROM `{$category->getTableName()}` ORDER BY `pathId` ASC ";
                $category = $category->fetchAll($query);
            }
            $this->category = $category;
            return $this;
        }
        public function getCategories()
        {
            if (!$this->category) {
                $this->setCategories();
            }
            return $this->category;
        }

        public function setCategoriesOptions($categoriesOptions = null)
        {
            if(!$categoriesOptions)
            {
                $categories = \Mage::getModel('Category');
                $query = "SELECT `categoryId`,`name` FROM `{$categories->getTableName()}`";
                
                $categories = $categories->fetchAll($query);
                if($categories)
                {
                    foreach ($categories->getData() as $category) {
                        $categoriesOptions[$category->categoryId] = $category->name;
                    }
                }
            }
            $this->categoriesOptions = $categoriesOptions;
            return $this;
        }

        public function getCategoriesOptions()
        {
            if(!$this->categoriesOptions)
            {
                $this->setCategoriesOptions();
            }
            return $this->categoriesOptions;
        }

        public function getName($category)
        {
            $categoriesData = $this->getCategoriesOptions();
            $pathId = explode('=', $category->pathId);
            foreach ($pathId as &$id ) {
                if(array_key_exists($id, $categoriesData))
                {
                    $id = $categoriesData[$id];
                }
            }
            return implode('=>', $pathId);
        }

    }
    

?>