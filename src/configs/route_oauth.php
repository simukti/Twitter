<?php
return array(
    'oauth-index' => array(
        'type'  => 'Zend_Controller_Router_Route_Static',
        'route' => 'oauth',
        'defaults' => array(
            'controller' => 'oauth',
            'action'     => 'index',
        ),
    ),
    'oauth-login' => array(
        'type'  => 'Zend_Controller_Router_Route_Static',
        'route' => 'oauth_login',
        'defaults' => array(
            'controller' => 'oauth',
            'action'     => 'login',
        ),
    ),
    'oauth-logout' => array(
        'type'  => 'Zend_Controller_Router_Route_Static',
        'route' => 'oauth_logout',
        'defaults' => array(
            'controller' => 'oauth',
            'action'     => 'logout',
        ),
    ),
    'oauth-callback' => array(
        'type'  => 'Zend_Controller_Router_Route_Static',
        'route' => 'oauth_callback',
        'defaults' => array(
            'controller' => 'oauth',
            'action'     => 'callback',
        ),
    ),
);