<?php
    Mage::loadFileByClassName('Model_Core_Request');
    class Block_Core_Template extends Model_Core_Request
    {
        
        
        protected $request = null;

        protected $url = null;

        protected $template = null;
        protected $children = [];
        protected $title =  null;

        public function __construct()
        {
            $this->setRequest();
            $this->setUrl();
            $this->getUrl();
        }

        public function setTemplate($template)
        {
            $this->template = $template;
        }
        public function getTemplate()
        {
            return $this->template;
        }

        public function toHtml()
        {
            ob_start();
            require_once $this->getTemplate();
            $content = ob_get_contents();
            ob_end_clean();
            return $content;
        }

        

        public function setChildren(array $children = [])
        {
            $this->children = $children;
            return $this;
        }

        public function getChildren()
        {
            return $this->children;
        }

        public function addChild(Block_Core_Template $child , $key = null)
        {
            if(!$key)
            {
                $key = get_class($child);
            }
            $this->children[$key] = $child;
            return $this;
        }

        public function getChild($key)
        {
            if(!array_key_exists($key , $this->children))
            {
                return null;
            }
            return $this->children[$key];
        }

        public function removeChild($key)
        {
            if(!array_key_exists($key , $this->children))
            {
                unset($this->children[$key]);
            }
            return $this;
        }

        public function setUrl($url = null)
        {
            if(!$url)
            {
                $url = Mage::getModel('Core_Url');
            }
            $this->url = $url;
            return $this;
        }
        public function getUrl()
        {
            if(!$this->url)
            {
                $this->setUrl();
            }
            return $this->url;
        }

        public function getMessage()
        {
            return Mage::getModel('Admin_Message');
        }
        public function createBlock($className)
        {
            return Mage::getBlock($className);
        }

        public function setRequest()
        {
            $this->request = Mage::getModel('Core_Request');
            return $this;
        }
        public function getRequest()
        {
            return $this->request;
        }

        public function setTitle($title)
        {
            $this->title = $title;
        }
        public function getTitle()
        {
            return $this->title;
        }

        public function baseUrl($subUrl = null)
        {
            return $this->getUrl()->baseUrl($subUrl);
        }

    }
    
?>