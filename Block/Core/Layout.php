<?php

    Mage::loadFileByClassName("Block_Core_Template");

    class Block_Core_Layout extends Block_Core_Template
    {

        public function __construct()
        {
            parent::__construct();
            $this->setTemplate("./view/core/layout/three-column.php");
            $this->preparedChild();
        }

        public function preparedChild()
        {
            $this->addChild(Mage::getBlock('Core_Layout_Header'), 'header');
            $this->addChild(Mage::getBlock('Core_Layout_Left'), 'left');
            $this->addChild(Mage::getBlock('Core_Layout_Content'), 'content');
            $this->addChild(Mage::getBlock('Core_Layout_Right'), 'right');
            $this->addChild(Mage::getBlock('Core_Layout_Footer'), 'footer');
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