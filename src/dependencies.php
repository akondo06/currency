<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
// $container['renderer'] = function ($c) {
// 	$settings = $c->get('settings')['renderer'];
// 	return new Slim\Views\PhpRenderer($settings['template_path']);
// };

// Laravel Blade 3.*
$container['renderer'] = function($c) {
	$settings = $c->get('settings')['renderer'];
	return new Slim\Views\Blade($settings['template_path'], $settings['cache_path']);
};

// monolog
$container['logger'] = function($c) {
	$settings = $c->get('settings')['logger'];
	$logger = new Monolog\Logger($settings['name']);
	$logger->pushProcessor(new Monolog\Processor\UidProcessor());
	$logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
	return $logger;
};

// Load Helpers here ....
require __DIR__ . '/classes/helpers/urlFor.php';

// db
$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};

$container['session'] = function ($c) {
	return new \SlimSession\Helper;
};

$container[App\Controllers\Home::class] = function($c) {
	return new \App\Controllers\Home($c);
};


// define('DB', $container['db']);


