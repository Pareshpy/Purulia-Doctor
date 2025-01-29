<?php
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable('./');
$dotenv->load();
$appConfig = [
    'settings' => [
        'displayErrorDetails' => true,
        'db' => [
            'driver'    => $_ENV['DRIVER'],
            'host'      => $_ENV['HOST'],
            'database'  => $_ENV['DATABASE'],
            'username'  => $_ENV['USERNAME'],
            'password'  => $_ENV['PASSWORD'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ]
];
