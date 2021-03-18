<?php
    require_once './Controller/Core/Front.php';
    class Mage  {
        public static function init()  
        {
            Controller_Core_Front::init();
        }
        public static function getController($className)
        {
            $className = 'Controller_'.$className;
            self::loadFileByClassName($className);
            $className = str_replace('_',' ',$className);
            $className = ucwords($className);
            $className = str_replace(' ','_',$className);
            return new $className();
        }
        public static function getModel($className)
        {
            $className = 'Model_'.$className;
            self::loadFileByClassName($className);
            $className = str_replace('_',' ',$className);
            $className = ucwords($className);
            $className = str_replace(' ','_',$className);
            return new $className();
        }
        public static function getBlock($className)
        {
            $className = 'Block_'.$className;
            self::loadFileByClassName($className);
            $className = str_replace('_',' ',$className);
            $className = ucwords($className);
            $className = str_replace(' ','_',$className);
            return new $className();
        }
        public static function loadFileByClassName($className)
        {
            $className = str_replace('_',' ',$className);
            $className = ucwords($className);
            $className = str_replace(' ','/',$className);
            $className = $className.'.php';
            require_once ($className);
        }
        
    }
    Mage::init();
    
?>
