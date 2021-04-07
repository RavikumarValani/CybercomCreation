<?php 
namespace Block\Admin\Category\Edit;

    \Mage::loadFileByClassName('Block\Core\Edit\Tabs');

    class Tabs extends \Block\Core\Edit\Tabs
    {
        public function prepareTab()
        {
            $this->addTab('category',['label' => 'Category Information','default' => true, 'block' => 'Block\Admin\Category\Edit\Tabs\Form']);
            $this->addTab('Media',['label' => 'Media','default' => true, 'block' => 'Block\Admin\Category\Edit\Tabs\Media']);
            $this->setDefaultTab('category');
            return $this;
        }

        
    }
    
?>