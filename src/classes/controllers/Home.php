<?php

namespace App\Controllers;

use App\Models\Rate;
use App\Models\RateValue;

class Home {
	public function __construct(\Slim\Container $container) {
		$this->renderer = $container->get('renderer');
		$this->logger = $container->get('logger');
		$this->db = $container->get('db');
	}
   
	public function index($request, $response, $args) {
		// Sample log message
		$this->logger->info('Slim-Skeleton \'/\' route');

		// $args['rates'] = Rate::where('currency', 'RON')->get()->values();
		// $args['rates'] = RateValue::where('published_on', '2016-11-04')->get();
		// $args['rates'] = RateValue::getEquivalentValue('RON', 4, ['EUR', 'USD', 'RON', 'DKK']);  // DIN RO in EUR, USD, RON, DKK ... 
		// $args['rates'] = RateValue::getEquivalentValue('EUR', 1, ['EUR', 'USD', 'RON', 'DKK']); // DIN EUR in RO

		// Homepage table data here ...
		$base_rate = 'RON';
		$args['rate'] = Rate::where('currency', $base_rate)->first();
		$args['rateValues'] = RateValue::where('published_on', '2016-11-04')->getEquivalentValue($base_rate, 1, null, [$base_rate]);

		// Render index view
		return $this->renderer->render($response, 'home', $args);
	}

	public function page($request, $response, $args) {
		return $this->renderer->render($response, 'page', $args);
	}
}
