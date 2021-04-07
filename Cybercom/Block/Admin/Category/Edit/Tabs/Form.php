<?php
namespace Block\Admin\Category\Edit\Tabs;

    \Mage::loadFileByClassName('Block\Core\Edit');

    class Form extends  \Block\Core\Edit
    {
        protected $categoryOptions = null;

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/admin/category/edit/tabs/form.php');
        }

        public function setCategoryOptions($categoryOptions = null)
        {
            $categories = \Mage::getModel('Category');
            $query = "SELECT `categoryId`,`name` FROM `{$this->getTableRow()->getTableName()}` ";
            $options = $categories->getAdapter()->fetchPairs($query);

            $query = "SELECT `categoryId`,`pathId` FROM `{$this->getTableRow()->getTableName()}` ORDER BY `pathId` ASC ";
            $categoryOptions = $categories->getAdapter()->fetchPairs($query);

            if($categoryOptions)
            {
                foreach ($categoryOptions as $categoryId => &$pathId) {
                    $pathIds = explode("=", $pathId);
                    foreach ($pathIds as $key => &$id) {
                        if(array_key_exists($id, $options))
                        {
                            $id = $options[$id];
                        }
                    }
                    $pathId = implode("/", $pathIds);
                }
            }
            $categoryOptions = ["" => "Root Category"] + $categoryOptions;
            
            $this->categoryOptions = $categoryOptions;
            return $this;
        }

        public function getCategoryOptions()
        {
            if(!$this->categoryOptions)
            {
                $this->setCategoryOptions();
            }
            return $this->categoryOptions;
        }

        public function getHeading()
        {
            $this->setTitle('Add Detail');

            if((int) $this->getRequest()->getGet('categoryId'))
            {
                $this->setTitle('Update Detail');
            }
            return $this->getTitle();
        }
    }
    
?>