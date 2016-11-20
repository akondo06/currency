<?php

namespace App\Controllers;

use App\Models\Currency;
use App\Models\Rate;

class ChartData extends \App\Controllers\Base {
	public function index($request, $response, $args) {
		// /json/{currency}/{base_currency}/{start_date}/{end_date}

		// Needs some validation here .. check if it's higher than today .. etc...
		$currency = $args['currency'];
		$base_currency = $args['base_currency'];
		$start_date = new \DateTime($args['start_date']);
		$start_date = $start_date->format('Y-m-d');
		$end_date = new \DateTime($args['end_date']);
		$end_date = $end_date->format('Y-m-d');

		$rates = Rate::
			whereDate('published_on', '>=', $start_date)
			->whereDate('published_on', '<=', $end_date)
			->getEquivalentValues($base_currency, 1, [$currency]);

		$result = [];
		$min = null;
		$max = null;
		foreach($rates as $rate) {
			$format = (object) ['my_date' => $rate->published_on, 'my_value' => $rate->converted_value];

			$result[] = $format;

			if(!$min || $format->my_value < $min->my_value) {
				$min = $format;
			}
			if(!$max || $format->my_value >= $max->my_value) {
				$max = $format;
			}
		}

		$min->bullet = "round";
		$min->label = "min";
		$min->bulletClass = 'min-pulsating-bullet';

		$max->bullet = "round";
		$max->label = "max";
		$max->bulletClass = 'max-pulsating-bullet';

		return $response
			->withStatus(200)
			->withHeader('Content-Type', 'application/json')
			->write(json_encode($result));
	}
}
