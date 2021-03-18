<?php
    Mage::loadFileByClassName("Block_Core_Template");
    class Block_Category_Grid extends Block_Core_Template  
    {
        protected $category = [];
        protected $categoriesOptions = [];
        
        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/category/grid.php');
        }
        public function setCategories($category = null)
        {
            if(!$category){
                $category = Mage::getModel('Category');
                $category = $category->fetchAll()->getData();
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
                $query = "SELECT categoryId,name FROM category";
                $categories = Mage::getModel('Category')->fetchAll($query);
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