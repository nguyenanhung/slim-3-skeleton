<?php
return [
    'settings' => [
        'displayErrorDetails'    => TRUE, // set to false in production
        'addContentLengthHeader' => FALSE, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer'               => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger'                 => [
            'name'  => 'app',
            'path'  => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../storage/logs/Log-' . date('Y-m-d') . '.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Cấu hình Database
        'db'                     => [
            'dsn'      => 'mysql:host=127.0.0.1;dbname=test_database;charset=utf8',
            'username' => 'root',
            'password' => '',
        ]

    ],
];
