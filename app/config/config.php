<?php
return new \Phalcon\Config([
    'baseUri' => '/',
    'database' => [
        'adapter' => 'Mysql',
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => 'password',
        'dbname' => 'phalcon-single'
    ],
    'application' => [
        'controllersDir' => APP_DIR . '/controllers/',
        'modelsDir'      => APP_DIR . '/models/',
        'formsDir'       => APP_DIR . '/forms/',
        'viewsDir'       => APP_DIR . '/views/',
        'libraryDir'     => APP_DIR . '/library/',
        'cacheDir'       => BASE_DIR . '/cache/',
    ],
    'mail' => [
        'fromName' => 'Ali Jafari',
        'fromEmail' => 'ali@jafari.pw',
        'smtp' => [
            'server' => 'smtp.gmail.com',
            'port' => 587,
            'security' => 'tls',
            'username' => '',
            'password' => ''
        ]
    ],
]);