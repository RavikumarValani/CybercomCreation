<?php
namespace Model\Core;

    \Mage::loadFileByClassName('Model\Core\Session');

    class Message extends \Model\Core\Session
    {
        public function setSuccess($message)
        {
            $this->success = $message;
            return $this;
        }
        public function getSuccess()
        {
            return $this->suceess;
        }
        public function setFailure($message)
        {
            $this->failure = $message;
            return $this;
        }
        public function getFailure()
        {
            return $this->failure;
        }
        public function clearSuccess()
        {
            unset($this->success);
            return $this;
        }
        public function clearFailure( )
        {
            unset($this->getFailure);
            return $this;
        }
    }
    
?>