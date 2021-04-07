<?php
namespace Block\Core;

    \Mage::loadFileByClassName('Model\Core\Request');
    
    class Template extends \Model\Core\Request
    {
        
        
        protected $request = null;

        protected $url = null;

        protected $template = null;
        protected $children = [];
        protected $title =  null;
        protected $tabs = [];
        protected $defaultTab = null;

        public function __construct()
        {
            $this->setRequest();
            $this->setUrl();
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

        public function addChild(\Block\Core\Template $child , $key = null)
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
                $url = \Mage::getModel('Core\Url');
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
            return \Mage::getModel('Admin\Message');
        }

        public function createBlock($className)
        {

            return \Mage::getBlock($className);
        }

        public function setRequest()
        {
            $this->request = \Mage::getModel('Core\Request');
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

        public function setDefaultTab($defaultTab)
        {
            $this->defaultTab = $defaultTab;
            return $this;
        }
        public function getDefaultTab()
        {
            return $this->defaultTab;
        }
        public function setTabs(array $tabs)
        {
            $this->tabs = $tabs;
            return $this;
        }

        public function getTabs()
        {
            return $this->tabs;
        }

        public function addTab($key, $tab = [])
        {
            $this->tabs[$key] = $tab;
            return $this;
        }

        // public function getTab($key)
        // {
        //     if(!array\key_exists($key, $this->tabs))
        //     {
        //         return null;
        //     }
        //     return $this->tabs[$key];
        // }

        public function removeTab($key)
        {
            if(array_key_exists($key, $this->tabs))
            {
                unset($this->tabs[$key]);
            }
            return $this;
        }
        public function baseUrl($subUrl = null)
        {
            return $this->getUrl()->baseUrl($subUrl);
        }

    }
    
?>