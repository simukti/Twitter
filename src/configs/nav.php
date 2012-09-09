<?php
return array(
    'pages' => array(
        'timeline' => array(
            'label' => '{{i class=||icon-th-list||}}{{/i}} Timeline', // this label format is for rendering h a c k
            'route' => 'index-timeline',
            'order' => '-100',
            'visible' => true,
            'id'    => 'timeline'
        ),
        'replies' => array(
            'label' => '{{i class=||icon-share||}}{{/i}} Replies', // this label format is for rendering h a c k
            'route' => 'index-replies',
            'visible' => true,
            'id'    => 'replies'
        ),
        'dm' => array(
            'label' => '{{i class=||icon-envelope||}}{{/i}} DM', // this label format is for rendering h a c k
            'route' => 'dm-index',
            'visible' => true,
            'id'    => 'dm'
        ),
        'logout' => array(
            'label' => '{{i class=||icon-off||}}{{/i}} Logout', // this label format is for rendering h a c k
            'route' => 'oauth-logout',
            'visible' => true
        ),
    ),
);