<?php
return array(
    'tweet-reply' => array(
        'type'  => 'Zend_Controller_Router_Route',
        'route' => 'tweet_reply/:id',
        'defaults' => array(
            'controller' => 'tweet',
            'action'     => 'reply',
        ),
        'reqs' => array(
            'id' => '\d+'
        )
    ),
    'tweet-show' => array(
        'type'  => 'Zend_Controller_Router_Route',
        'route' => 'show_tweet/:id',
        'defaults' => array(
            'controller' => 'tweet',
            'action'     => 'show',
        ),
        'reqs' => array(
            'id' => '\d+'
        )
    ),
    'tweet-delete' => array(
        'type'  => 'Zend_Controller_Router_Route',
        'route' => 'delete_tweet/:id/:token',
        'defaults' => array(
            'controller' => 'tweet',
            'action'     => 'delete',
        ),
        'reqs' => array(
            'id' => '\d+',
            'token' => '[a-f0-9]+'
        )
    ),
);