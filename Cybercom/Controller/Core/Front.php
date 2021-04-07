<?php

namespace Controller\Core;

    class Front 
    {
        public static function init()
        {
            $request = \Mage::getModel('Core\Request');

            $controllerName = $request->getControllerName();
            $className =  self::prepareClassName($controllerName, 'Controller\Admin');
            
            $controller = \Mage::getController($className);
            
            $actionName = $request->getActionName()."Action";
            $controller->$actionName();

        }

        public static function prepareClassName($key, $namespace)
        {
            $className = $namespace."\\".$key;
            $className = str_replace("\\", " ", $className);
            $className = ucwords($className);
            $className = str_replace(" ", "\\", $className);
            return $className;
        }
    }

?>