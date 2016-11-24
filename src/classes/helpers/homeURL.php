<?php

if(!function_exists('homeURL')) {
	function homeURL() {
		global $container, $app;
		$env = $container->get('environment');
        $uri = Slim\Http\Uri::createFromEnvironment($env);
		return $uri->getBaseUrl();
		// https://github.com/slimphp/Slim/blob/3.x/Slim/Http/Uri.php
	}
}