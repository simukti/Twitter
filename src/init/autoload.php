<?php
return call_user_func(function() {
    $includePaths = include __DIR__ . DS . 'include_paths.php';
    set_include_path(implode(PATH_SEPARATOR, $includePaths));
    
    require_once (LIB_PATH . DS. 'zf1'. DS . 'Zend' . DS . 'Loader' . DS .'Autoloader.php');
    $loader = Zend_Loader_Autoloader::getInstance();
    $loader->registerNamespace('Twitter');
    return $loader;
});