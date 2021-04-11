<?php 
namespace Controller\Core;

    \Mage::loadFileByClassName('Block\Core\Layout');

    class Abstracts
    {
        protected $layout = null;
        protected $request = null;
        protected $message = null;

        public function __construct()
        {
            $this->setLayout();
            $this->setMessage();
        }

        public function setLayout(\Block\Core\Layout $layout = null)
        {
            if(!$layout)
            {
                $layout = \Mage::getBlock('Core\Layout');
            }
            $this->layout = $layout;
            return $this;
        }
        public function getLayout()
        {
            return $this->layout;
        }

        public function setRequest($request = null)
        {
            if(!$request)
            {
                $request = \Mage::getModel('Core\Request');
            }
            $this->request = $request;
            return $this;
        }
        public function getRequest()
        {
            if(!$this->request)
            {
                $this->setRequest();
            }
            return $this->request;
        }

        public function setMessage()
        {
            $this->message = \Mage::getModel('Admin\Message');
            return $this;
        }
        public function getMessage()
        {
            return $this->message;
        }

        public function redirect($actionName=null,$controllerName=null,$params=null,$resetParams=false)
        {
            header("location: ".$this->getUrl($actionName,$controllerName,$params,$resetParams));
            exit();
        }

        public function getUrl($actionName=null,$controllerName=null,$params=null,$resetParams=false)
        {
            $final = $_GET;
            if($resetParams)
            {
                $final = [];
            }
            if ($actionName == null) 
            {
                $actionName = $this->getRequest()->getActionName();
            }
            if ($controllerName == null) 
            {
                $controllerName = $this->getRequest()->getControllerName();
            }

            $final['c'] = $controllerName;
            $final['a'] = $actionName;

            if(is_array($params))
            {
                $final = array_merge($final,$params);
            }

            $urlString = http_build_query($final);
            return "http://localhost:8080/cybercom1/index.php?{$urlString}";
        }

        public function toLayoutHtml()
        {
            echo $this->getLayout()->toHtml(); 
        }
    }
    
?>