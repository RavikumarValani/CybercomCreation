<?php 
namespace Controller\Core;

    \Mage::loadFileByClassName('Controller\Core\Abstracts');
    \Mage::loadFileByClassName('Block\Customer\Layout');

    class Customer extends \Controller\Core\Abstracts
    {
        protected $layout = null;
        protected $message = null;

        public function setLayout(\Block\Core\Layout $layout = null)
        {
            if(!$layout)
            {
                $layout = \Mage::getBlock('Customer\Layout');
            }

            if(!$layout instanceof \Block\Customer\Layout)
            {
                throw new \Exception('Layout is Instance Of Block_Customer_Layout');
            }

            $this->layout = $layout;
            return $this;
        }
        public function setMessage()
        {
            $this->message = \Mage::getModel('Customer\Message');
            return $this;
        }
    }
    
?>