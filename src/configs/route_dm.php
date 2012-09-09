<?php
return array(
    'dm-index' => array(
        'type'  => 'Zend_Controller_Router_Route',
        'route' => 'dm/:page',
        'defaults' => array(
            'controller' => 'dm',
            'action'     => 'index',
            'page' => 1
        ),
        'reqs' => array(
            'page' => '\d+'
        )
    ),
    'dm-sent' => array(
        'type'  => 'Zend_Controller_Router_Route',
        'route' => 'dm_sent/:page',
        'defaults' => array(
            'controller' => 'dm',
            'action'     => 'sent',
            'page' => 1
        ),
        'reqs' => array(
            'page' => '\d+'
        )
    ),
    'dm-write' => array(
        'type'  => 'Zend_Controller_Router_Route',
        'route' => 'dm_write/:id_user',
        'defaults' => array(
            'controller' => 'dm',
            'action'     => 'write',
        ),
        'reqs' => array(
            'id_user' => '\d+'
        )
    ),
    'dm-delete' => array(
        'type'  => 'Zend_Controller_Router_Route',
        'route' => 'dm_delete/:id',
        'defaults' => array(
            'controller' => 'dm',
            'action'     => 'delete',
        ),
        'reqs' => array(
            'id' => '\d+'
        )
    ),
);