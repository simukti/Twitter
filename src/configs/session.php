<?php
return array(
    'use_only_cookies'          => true,
    'name'                      => 'twitterForSimukti_',
    'remember_me_seconds'       => 3600 * 24 * 7, // no rememberMe feature
    'save_path'                 => SESSION_PATH,
    'cookie_httponly'           => true,
    'cookie_path'               => '/',
    'hash_function'             => 'gost',
    'hash_bits_per_character'   => 6,
);