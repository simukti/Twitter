<?php
return array(
    'index-index' => array( /* This TweetController::writeAction() === lightweight :D */
        'type'  => 'Zend_Controller_Router_Route_Static',
        'route' => '',
        'defaults' => array(
            'controller' => 'tweet',
            'action'     => 'write',
        ),
    ),
    'index-timeline' => array(
        'type'  => 'Zend_Controller_Router_Route',
        'route' => 'timeline/:page',
        'defaults' => array(
            'controller' => 'index',
            'action'     => 'index',
            'page'       => 1
        ),
        'reqs' => array(
            'page' => '\d+'
        )
    ),
    'index-replies' => array(
        'type'  => 'Zend_Controller_Router_Route',
        'route' => 'replies/:page',
        'defaults' => array(
            'controller' => 'index',
            'action'     => 'replies',
            'page'       => 1
        ),
        'reqs' => array(
            'page' => '\d+'
        )
    ),
    'index-followers' => array(
        'type'  => 'Zend_Controller_Router_Route',
        'route' => 'followers/:page',
        'defaults' => array(
            'controller' => 'index',
            'action'     => 'followers',
            'page'       => 1
        ),
        'reqs' => array(
            'page' => '\d+'
        )
    ),
    'index-hashtag' => array(
        'type'  => 'Zend_Controller_Router_Route',
        'route' => 'hashtag/:tag',
        'defaults' => array(
            'controller' => 'index',
            'action'     => 'hashtag',
        ),
        'reqs' => array(
            'tag' => '([a-z0-9A-Z]+)'
        )
    ),
    
    'index-show_user' => array(
        'type'  => 'Zend_Controller_Router_Route',
        'route' => 'show_user/:screen_name',
        'defaults' => array(
            'controller' => 'index',
            'action'     => 'show-user',
        ),
        'reqs' => array(
            'screen_name' => '([A-Za-z0-9_]{1,30})'
        )
    ),
    'index-show_user_tweets' => array(
        'type'  => 'Zend_Controller_Router_Route',
        'route' => 'show_user_tweets/:screen_name',
        'defaults' => array(
            'controller' => 'index',
            'action'     => 'show-user-tweets',
        ),
        'reqs' => array(
            'screen_name' => '([A-Za-z0-9_]{1,30})',
        )
    ),
    'index-show_user_following' => array(
        'type'  => 'Zend_Controller_Router_Route',
        'route' => 'show_user_following/:screen_name',
        'defaults' => array(
            'controller' => 'index',
            'action'     => 'show-user-following',
        ),
        'reqs' => array(
            'screen_name' => '([A-Za-z0-9_]{1,30})',
        )
    ),
    'index-show_user_faves' => array(
        'type'  => 'Zend_Controller_Router_Route',
        'route' => 'show_user_faves/:screen_name',
        'defaults' => array(
            'controller' => 'index',
            'action'     => 'show-user-faves',
        ),
        'reqs' => array(
            'screen_name' => '([A-Za-z0-9_]{1,30})',
        )
    ),
    'index-friendship_create' => array(
        'type'  => 'Zend_Controller_Router_Route',
        'route' => 'friendship_create/:id_user/:token',
        'defaults' => array(
            'controller' => 'index',
            'action'     => 'follow-user'
        ),
        'reqs' => array(
            'id_user' => '\d+',
            'token'   => '[a-f0-9]+'
        )
    ),
    'index-friendship_destroy' => array(
        'type'  => 'Zend_Controller_Router_Route',
        'route' => 'friendship_destroy/:id_user/:token',
        'defaults' => array(
            'controller' => 'index',
            'action'     => 'unfollow-user',
        ),
        'reqs' => array(
            'id_user' => '\d+',
            'token'   => '[a-f0-9]+'
        )
    ),
);