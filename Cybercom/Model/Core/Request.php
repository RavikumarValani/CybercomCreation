<?php
namespace Model\Core;

    class Request 
    {
        public function getPost($key = null,$optionalValue = null)
        {
            if(!$key)
            {
                return $_POST;
            }
            if(!array_key_exists($key,$_POST))
            {
                return $optionalValue;
            }
            return $_POST[$key];
        }

        public function getGet($key = null,$optionalValue = null)
        {
            if(!$key)
            {
                return $_GET;
            }
            if(!array_key_exists($key,$_GET))
            {
                return $optionalValue;
            }
            return $_GET[$key];
        }

        public function getFiles($key = null,$optionalValue = null)
        {
            if(!$key)
            {
                return $_FILES;
            }
            if(!array_key_exists($key,$_FILES))
            {
                return $optionalValue;
            }
            return $_FILES[$key];
        }

        public function isPost()
        {
            if($_SERVER['REQUEST_METHOD'] != 'POST')
            {
                return false;
            }
            return true;
        }
        
        public function getActionName()
        {
            return $this->getGet('a','index');
        }
        public function getControllerName()
        {
            return $this->getGet('c','index');
        }
    }
?>