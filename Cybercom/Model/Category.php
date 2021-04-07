<?php
namespace Model;

    \Mage::loadFileByClassName("Model\Core\Table");

    class Category extends \Model\Core\Table
    {
        const STATUS_ENABLE = 1;
        const STATUS_DISABLE = 0;

        public function __construct()
        {
            $this->setTableName('category');
            $this->setPrimaryKey('categoryId');
        }

        public function getStatusOption()
        {
            return [
                self::STATUS_ENABLE => "Enable",
                self::STATUS_DISABLE => "Disable"
            ];
        }

        public function updatePathId()
        {
            if(!$this->parentId)
            {
                $pathId = $this->categoryId;
            }
            else
            {
                $parent = \Mage::getModel('Category')->load($this->parentId);
                if(!$parent)
                {
                    throw new \Exception("Unable to load parent.");
                }
                $pathId = $parent->pathId."=".$this->categoryId;
            }
            $this->pathId = $pathId;
            
            return $this->save();
        }

        public function updateChildrenPathIds($pathId, $parentId = null)
        {
            $pathId = $pathId."=";
            $query = "SELECT * FROM `{$this->getTableName()}` WHERE `pathId` LIKE '{$pathId}%' ORDER BY pathId ASC";
            $categories = $this->fetchAll($query);
        
            if($categories)
            {
                foreach ($categories->getData() as $row) {
                    if($parentId)
                    {
                        $row->parentId = $parentId;
                    }
                    $row->updatePathId();
                }
            }
        }
    }
    
?>