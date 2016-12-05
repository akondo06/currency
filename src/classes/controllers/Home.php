<?php

namespace App\Controllers;

use App\Models\Currency;
use App\Models\Rate;

class Home extends \App\Controllers\Base {
	public function index($request, $response, $args) {
		// // Sample log message
		// $this->logger->info('Slim-Skeleton \'/\' route');
		$session = $this->session;

		// Homepage table data here ...
		if($request->isPost()) {
			$form = $request->getParsedBody();
			if(array_key_exists('index_date', $form) && array_key_exists('index_currency', $form)) {
				$session->set('index_date', $form['index_date']);
				$session->set('index_currency', $form['index_currency']);
			} else {
				$session->set('index_date', null);
				$session->set('index_currency', null);
			}
		}

		if(!$session->get('index_date')) {
			$session->set('index_date', date('Y-m-d'));
		}
		if(!$session->get('index_currency')) {
			$session->set('index_currency', 'RON');
		}

		$args['index_date'] = $session->get('index_date');
		$args['index_currency'] = $session->get('index_currency');

		$index_currency = $session->get('index_currency');
		$args['currency'] = Currency::where('currency', $index_currency)->first();


		$rates = Rate::onDate($args['index_date'])->getEquivalentValues($index_currency, 1, null, null, true);
		
		$date_yesterday = new \DateTime($rates[0]->published_on);
		$date_yesterday = $date_yesterday->sub(\DateInterval::createFromDateString('1 day'));
		$rates_yesterday = Rate::onDate($date_yesterday->format('Y-m-d'))->getEquivalentValues($index_currency, 1, null, null, true);
		$date_yesterday = $date_yesterday->sub(\DateInterval::createFromDateString('1 day'));
		$rates_two_days_before = Rate::onDate($date_yesterday->format('Y-m-d'))->getEquivalentValues($index_currency, 1, null, null, true);

		foreach($rates as $index => $rate) {
			$rate->yesterday = $rates_yesterday[$index];
			$rate->two_days_before = $rates_two_days_before[$index];
		}


		$args['rates'] = $rates;

		// Render index view
		return $this->renderer->render($response, 'home', $args);
	}

	public function evolution($request, $response, $args) {
		return $this->renderer->render($response, 'evolution', $args);
	}

	public function convertor($request, $response, $args) {
		return $this->renderer->render($response, 'converter', $args);
	}

	public function history($request, $response, $args) {
		return $this->renderer->render($response, 'history', $args);
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
		$args['rates'] = Rate::onDate($date)->get();
		return $this->renderer->render($response, 'on-date', $args);
	}

	public function currency($request, $response, $args) {
		$session = $this->session;

		// Checking if currency exists .. otherwise .. render the 404 ...
		$currency = Currency::where('slug', $args['slug'])->first();
		if(!$currency) {
			return $response->withStatus(404);
		}


		$currency_session_path = 'currency_'.$currency->currency.'_';

		if($request->isPost()) {
			$form = $request->getParsedBody();
			if(array_key_exists('start_date', $form) && array_key_exists('end_date', $form) && array_key_exists('base_currency', $form)) {
				$session->set($currency_session_path.'start_date', $form['start_date']);
				$session->set($currency_session_path.'end_date', $form['end_date']);
				$session->set($currency_session_path.'base_currency', $form['base_currency']);
			} else {
				$session->set($currency_session_path.'start_date', null);
				$session->set($currency_session_path.'end_date', null);
				$session->set($currency_session_path.'base_currency', null);
			}
		}

		// Attrs
		$date = new \DateTime(); // today
		$end_date = $date->format('Y-m-d');

		$date->sub(\DateInterval::createFromDateString('6 months'));
		$date->sub(\DateInterval::createFromDateString('2 day'));
		$start_date = $date->format('Y-m-d');

		if(!$session->get($currency_session_path.'start_date')) {
			$session->set($currency_session_path.'start_date', $start_date);
		}
		if(!$session->get($currency_session_path.'end_date')) {
			$session->set($currency_session_path.'end_date', $end_date);
		}
		if(!$session->get($currency_session_path.'base_currency')) {
			$session->set($currency_session_path.'base_currency', 'RON');
		}

		$args['start_date'] = $session->get($currency_session_path.'start_date');
		$args['end_date'] = $session->get($currency_session_path.'end_date');
		$args['base_currency'] = $session->get($currency_session_path.'base_currency');

		$args['currency'] = $currency;


		$base_currency = $args['base_currency'];
		$start_date = $args['start_date'];
		$end_date = $args['end_date'];

		// Rates
		$rates = Rate::betweenDates($start_date, $end_date, 'desc')->getEquivalentValues($base_currency, 1, [$currency->currency], null, true);
		foreach($rates as $index => $rate) {
			$prev_index = $index + 1;
			if(isset($rates[$prev_index])) {
				$rate->yesterday = $rates[$prev_index];
			}
		}
		$rates->pop();

		$args['rates'] = $rates;
		return $this->renderer->render($response, 'currency', $args);
	}
}
