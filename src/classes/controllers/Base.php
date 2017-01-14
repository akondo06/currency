<?php

namespace App\Controllers;

/* Used to register stuff on the other controllers .. */

use App\Models\Rate;

class Base {
	public function __construct(\Slim\Container $container) {
		$this->renderer = $container->get('renderer');
		$this->logger = $container->get('logger');
		$this->db = $container->get('db');
		$this->session = $container->get('session');
		// $this->notFoundHandler = $container['notFoundHandler'];

		$this->latestDate = Rate::latestDate();
	}
}
