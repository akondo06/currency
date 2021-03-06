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
			$session->set('index_date', $this->latestDate);
		} else {
			$dateObj = new \DateTime($session->get('index_date'));
			$latestDate = new \DateTime($this->latestDate);
			if($dateObj > $latestDate) {
				$session->set('index_date', $latestDate->format('Y-m-d'));
			}
		}
		if(!$session->get('index_currency')) {
			$session->set('index_currency', 'RON');
		}

		$args['latestDate'] = $this->latestDate;
		$args['index_date'] = $session->get('index_date');
		$args['index_currency'] = $session->get('index_currency');

		$index_currency = $session->get('index_currency');
		$args['currency'] = Currency::where('currency', $index_currency)->first();


		$rates = Rate::onDate($args['index_date'])->getEquivalentValues($index_currency, 1, null, null, true);
		
		if($rates->count() > 0) {
			$date_yesterday = new \DateTime($rates[0]->published_on);
			$date_yesterday = $date_yesterday->sub(\DateInterval::createFromDateString('1 day'));
			$rates_yesterday = Rate::onDate($date_yesterday->format('Y-m-d'))->getEquivalentValues($index_currency, 1, null, null, true);
			$date_yesterday = $date_yesterday->sub(\DateInterval::createFromDateString('1 day'));
			$rates_two_days_before = Rate::onDate($date_yesterday->format('Y-m-d'))->getEquivalentValues($index_currency, 1, null, null, true);

			foreach($rates as $index => $rate) {
				$rate->yesterday = $rates_yesterday[$index];
				$rate->two_days_before = $rates_two_days_before[$index];
			}
		}


		$args['rates'] = $rates;

		// Render index view
		return $this->renderer->render($response, 'home', $args);
	}

	public function evolution($request, $response, $args) {
		$args['latestDate'] = $this->latestDate;
		return $this->renderer->render($response, 'evolution', $args);
	}

	public function convertor($request, $response, $args) {
		$args['latestDate'] = $this->latestDate;
		return $this->renderer->render($response, 'converter', $args);
	}

	public function history($request, $response, $args) {

		$date_max = new \DateTime($this->latestDate);
		$date_min = new \DateTime('2005-01-01');

		$date = new \DateTime('2005-01-01');
		$years = [];

		$allowed_week_days = [1, 2, 3, 4, 5];


		$month_names = ['Ianuarie', 'Februarie', 'Martie', 'Aprilie', 'Mai', 'Iunie', 'Iulie', 'August', 'Septembrie', 'Octombrie', 'Noiembrie', 'Decembrie'];

		$step = \DateInterval::createFromDateString('1 year');
		while($date >= $date_min && $date <= $date_max) {
			$year = (object) [ 'year' => $date->format('Y'), 'months' => [] ];

			foreach($month_names as $month_name) {
				$year->months[] = (object) ['month' => ucfirst($month_name), 'days' => [] ];
			}
			$years[] = $year;
			$date->add($step);
		}

		$step = \DateInterval::createFromDateString('1 day');
		foreach($years as $year) {
			$date = new \DateTime($year->year.'-01-01');

			while($date->format('Y') == $year->year) {
				if(in_array($date->format('N'), $allowed_week_days) && $date <= $date_max) {
					$month_no = intval($date->format('m')) - 1;
					$year->months[$month_no]->no = $date->format('m');
					$year->months[$month_no]->days[] = $date->format('d');
				}
				$date->add($step);
			}
		}

		foreach($years as $year) {
			$year->months = array_reverse($year->months);
		}

		$args['latestDate'] = $this->latestDate;
		$args['years'] = array_reverse($years);
		
		return $this->renderer->render($response, 'history', $args);
	}

	public function onDate($request, $response, $args) {
		$date = $this->latestDate;
		if(array_key_exists('date', $args)) {
			$dateObj = new \DateTime($args['date']);
			$current_date = new \DateTime($this->latestDate);
			if($dateObj < $current_date) {
				$date = $dateObj->format('Y-m-d');
			}
		}
		$args['latestDate'] = $this->latestDate;
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
		$date = new \DateTime($this->latestDate); // today
		$end_date = $date->format('Y-m-d');

		$date->sub(\DateInterval::createFromDateString('6 months'));
		$date->sub(\DateInterval::createFromDateString('2 day'));
		$start_date = $date->format('Y-m-d');

		if(!$session->get($currency_session_path.'start_date')) {
			$session->set($currency_session_path.'start_date', $start_date);
		}/* else {
			$dateObj = new \DateTime($session->get($currency_session_path.'start_date'));
			$current_date = new \DateTime($this->latestDate);
			if($dateObj < $current_date) {
				$start_date = $dateObj->format('Y-m-d');
			}
			$session->set($currency_session_path.'end_date', $start_date);
		}*/
		if(!$session->get($currency_session_path.'end_date')) {
			$session->set($currency_session_path.'end_date', $end_date);
		}/* else {
			$dateObj = new \DateTime($session->get($currency_session_path.'end_date'));
			$current_date = new \DateTime($this->latestDate);
			if($dateObj < $current_date) {
				$end_date = $dateObj->format('Y-m-d');
			}
			$session->set($currency_session_path.'end_date', $end_date);
		}*/
		if(!$session->get($currency_session_path.'base_currency')) {
			$session->set($currency_session_path.'base_currency', 'RON');
		}

		$args['latestDate'] = $this->latestDate;
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
