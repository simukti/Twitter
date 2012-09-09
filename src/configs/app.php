<?php 
$dir = dirname(__FILE__);

return array (
    'phpSettings' => array (
        'memory_limit'      => '192M',
        'error_reporting'   => true,
        'display_errors'    => true,
        'display_startup_errors' => true,
    ),
    'bootstrap' => array (
        'path'  => APPLICATION_PATH . DS . 'init' . DS .'TwitterBootstrap.php',
        'class' => 'TwitterBootstrap',
    ),
    'twitter' => include_once($dir . DS . 'twitter.php'),
    'resources'  => array (
        'cachemanager' => include_once($dir . DS . 'cache.php'),
        'frontController' => array (
            'throwErrors'         => true,
            'controllerDirectory' => APPLICATION_PATH . DS . 'controllers',
            'params' => array(
                'disableOutputBuffering' => true,
                'throwExceptions'   => true,
                'displayExceptions' => true,
            ),
        ),
        'layout' => array (
            'layoutPath'  => APPLICATION_PATH . DS . 'layouts',
            'layout'      => 'twitter',
        ),
        'locale' => array (
            'default'   => 'id_ID',
            'force'     => true,
            'cache'     => 'locale'
        ),
        'navigation' => include_once($dir . DS . 'nav.php'),
        'router' => array (
            'routes'  => include_once($dir . DS . 'route.php')
        ),
        'session' => include_once($dir . DS . 'session.php'),
        'view' => array (
            'doctype'     => 'HTML5',
            'encoding'    => 'utf8',
            'contentType' => 'text/html; charset=utf-8',
            'helperPath' => array(
                'View_Helper' => APPLICATION_PATH . DS . 'views' . DS . 'helpers',
            )
        ),
    ),
);