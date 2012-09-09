<?php
return array(
    'rest' => array(
        'frontendBackendAutoload' => false,
        'frontend' => array(
            'name' => 'Core',
            'customFrontendNaming' => false,
            'options' => array(
                'lifetime' => 3600, // 1 hour
                'automatic_serialization' => true,
                'automatic_cleaning_factor' => 0,
            ),
        ),
        'backend' => array(
            'name' => 'File',
            'customBackendNaming' => false,
            'options' => array(
                'cache_dir' => is_writable(CACHE_PATH) ? CACHE_PATH : sys_get_temp_dir(),
                'file_name_prefix' => 'rest_cache_',
                'cache_file_umask' => 0755,
                'file_locking' => false
            ),
        ),
    ),
    'locale' => array(
        'frontendBackendAutoload' => false,
        'frontend' => array(
            'name' => 'Core',
            'customFrontendNaming' => false,
            'options' => array(
                'lifetime' => 3600 * 24 * 30 * 12,// 1 year
                'automatic_serialization' => true,
                'automatic_cleaning_factor' => 0,
            ),
        ),
        'backend' => array(
            'name' => 'File',
            'customBackendNaming' => false,
            'options' => array(
                'cache_dir' => is_writable(CACHE_PATH) ? CACHE_PATH : sys_get_temp_dir(),
                'file_name_prefix' => 'locale_',
                'cache_file_umask' => 0755,
                'file_locking' => false
            ),
        ),
    ),
);