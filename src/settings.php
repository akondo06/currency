<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        'debug' => true,
        
        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../resources/views/',
            'cache_path' => __DIR__ . '/../cache/views/'
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
