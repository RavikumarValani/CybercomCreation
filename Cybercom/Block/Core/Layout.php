<?php
namespace Block\Core;

    \Mage::loadFileByClassName("Block\Core\Template");

    class Layout extends \Block\Core\Template
    {

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate('./view/core/layout/three-column.php');
            $this->preparedChild();
        }

        public function preparedChild()
        {
            $this->addChild(\Mage::getBlock('Core\Layout\Header'), 'header');
            $this->addChild(\Mage::getBlock('Core\Layout\Left'), 'left');
            $this->addChild(\Mage::getBlock('Core\Layout\Content'), 'content');
            $this->addChild(\Mage::getBlock('Core\Layout\Right'), 'right');
            $this->addChild(\Mage::getBlock('Core\Layout\Footer'), 'footer');
        } 

        public function getHeader()
        {
            return $this->getChild('header');
        }
        
        
        public function getLeft()
        {
            return $this->getChild('left');
        }
        
        public function getContent()
        {
            return $this->getChild('content');
        }

        public function getRight()
        {
            return $this->getChild('right');
        }
        
        public function getFooter()
        {
            return $this->getChild('footer');
        }

    }
    
?>