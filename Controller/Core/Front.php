<?php


    class Controller_Core_Front 
    {
        public static function init()
        {
            $request = Mage::getModel('Core_Request');

            $controllerName = ucfirst($request->getControllerName());
            $actionName = $request->getActionName()."Action";
            $className =  "./Controller/{$controllerName}";
            Mage::loadFileByClassName($className);
            
            $controllerName = "Controller_".$controllerName;

            $product =new $controllerName();
            $product->$actionName();

        }
    }

?>