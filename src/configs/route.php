<?php
$dir = dirname(__FILE__);

return array_merge_recursive(
    include_once($dir . DS . 'route_index.php'),
    include_once($dir . DS . 'route_oauth.php'),
    include_once($dir . DS . 'route_tweet.php'),
    include_once($dir . DS . 'route_dm.php')
);