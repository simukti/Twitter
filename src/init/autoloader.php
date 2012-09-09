<?php
define('DS',                DIRECTORY_SEPARATOR);

define('APPLICATION_PATH',  realpath(dirname(__FILE__) . DS . '..' . DS));

define('APPLICATION_ENV',   'production');

define('CONFIG_PATH',       APPLICATION_PATH . DS . 'configs');

define('VAR_PATH',          APPLICATION_PATH . DS . 'var');

define('CACHE_PATH',        VAR_PATH . DS . 'cache');

define('SESSION_PATH',      VAR_PATH . DS . 'session');

define('LIB_PATH',          APPLICATION_PATH . DS . 'library');

if (file_exists(dirname(__FILE__) . DS . 'autoload.php')) {
    $loader = require_once dirname(__FILE__) . DS . 'autoload.php';
    if(! class_exists('Zend_Loader_Autoloader')) {
        throw new RuntimeException('Unable to load autoloader.');
    }
}

if(isset($loader)) {
    $application = new Zend_Application(APPLICATION_ENV, CONFIG_PATH . DS . 'app.php');
    if(php_sapi_name() !== 'cli') {
        $application->bootstrap()->run();
    }
}