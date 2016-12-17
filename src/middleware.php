<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

$app->add(new \Slim\Middleware\Session([
	'name' => 'dummy_session',
	'autorefresh' => false,
	'lifetime' => '24 hours'
]));

$app->add(function($request, $response, $next) use($container) {
	// Add current route so it can be used in helpers.. fucking helll
	$route = $request->getAttribute('route');
	$container->currentRoute = $route;

	// First execute anything else
	$response = $next($request, $response);

	// Check if the response should render a 404
	if (404 === $response->getStatusCode() && 0 === $response->getBody()->getSize()) {
		// A 404 should be invoked
		$handler = $container['notFoundHandler'];
		return $handler($request, $response);
	}
	return $response;
});
