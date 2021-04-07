<?php
namespace Model;

    \Mage::loadFileByClassName("Model\Core\Table");
    
    class CMSPage extends \Model\Core\Table
    {
        const STATUS_ENABLE = 1;
        const STATUS_DISABLE = 0;

        public function __construct()
        {
            $this->setTableName('cms_page');
            $this->setPrimaryKey('pageId');
        }
        
        public function getStatusOption()
        {
            return [
                self::STATUS_ENABLE => "Enable",
                self::STATUS_DISABLE => "Disable"
            ];
        }
    }
    
?>