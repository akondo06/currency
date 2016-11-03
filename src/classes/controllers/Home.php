<?php

namespace App\Controllers;

class Home {
	public function __construct(\Slim\Container $container) {
		$this->renderer = $container->get('renderer');
		$this->logger = $container->get('logger');
	}
   
	public function index($request, $response, $args) {
		// Sample log message
		$this->logger->info('Slim-Skel eton \'/\' route');

		// Render index view
		return $this->renderer->render($response, 'home', $args);
	}

	public function page($request, $response, $args) {
		return $this->renderer->render($response, 'page', $args);
	}
}
