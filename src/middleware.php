<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

$app->add(new \Slim\Middleware\Session([
	'name' => 'dummy_session',
	'autorefresh' => false,
	'lifetime' => '24 hours'
]));
