<?php 
namespace Block\Admin\Config\Group\Edit;

    \Mage::loadFileByClassName('Block\Core\Edit\Tabs');

    class Tabs extends \Block\Core\Edit\Tabs
    {
        
        public function prepareTab()
        {
            parent::prepareTab();
            $this->addTab('config',['label' => 'Config information', 'block' => 'Block\Admin\Config\Group\Edit\Tabs\Form']);
            $this->addTab('Configuration', ['label' => 'Configuration', 'block' => 'Block\Admin\Config\Grid']);
            
            $this->setDefaultTab('config');
            return $this;
        }

        
    }
    
?>