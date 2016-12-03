<?php

namespace App\Controllers;

use App\Models\Currency;
use App\Models\Rate;

class ChartData extends \App\Controllers\Base {
	public function index($request, $response, $args) {
		// Needs some validation here .. check if it's higher than today .. etc...
		$currency = $args['currency'];
		$base_currency = array_key_exists('base_currency', $args) ? $args['base_currency'] : 'RON';

		$base_currency = 'RON';
		if(array_key_exists('base_currency', $args)) {
			$base_currency = $args['base_currency'];
		}
		$start_date = '2005-01-01';
		if(array_key_exists('start_date', $args)) {
			$start_date = new \DateTime($args['start_date']);
			$start_date = $start_date->format('Y-m-d');
		}
		$end_date = date('Y').'-12-31';
		if(array_key_exists('end_date', $args)) {
			$end_date = new \DateTime($args['end_date']);
			$end_date = $end_date->format('Y-m-d');
		}

		$rates = Rate::
			betweenDates($start_date, $end_date)
			->getEquivalentValues($base_currency, 1, [$currency], null, true);

		$result = [];
		$min = null;
		$max = null;
		foreach($rates as $rate) {
			$format = (object) ['date' => $rate->published_on, 'value' => $rate->converted_value];

			$result[] = $format;

			if(!$min || $format->value < $min->value) {
				$min = $format;
			}
			if(!$max || $format->value >= $max->value) {
				$max = $format;
			}
		}

		if($min) {
			$min->bullet = "round";
			$min->label = "min";
			$min->bulletClass = 'min-pulsating-bullet';
		}
		if($max) {
			$max->bullet = "round";
			$max->label = "max";
			$max->bulletClass = 'max-pulsating-bullet';
		}
		return $response
			->withStatus(200)
			->withHeader('Content-Type', 'application/json')
			->write(json_encode($result));
	}

	public function onDate($request, $response, $args) {
		$date = date('Y-m-d');
		if(array_key_exists('date', $args)) {
			$dateObj = new \DateTime($args['date']);
			$current_date = new \DateTime();
			if($dateObj < $current_date) {
				$date = $dateObj->format('Y-m-d');
			}
		}


		$result = (object) ['published_on' => $date, 'values' => (object)[] ];

		$rates = Rate::onDate($date)->get();

		foreach($rates as $rate) {
			$currency = $rate->currency;
			$result->values->$currency = $rate->value;
		}

		return $response
			->withStatus(200)
			->withHeader('Content-Type', 'application/json')
			->write(json_encode($result));
	}
}
