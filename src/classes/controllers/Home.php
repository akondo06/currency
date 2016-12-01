<?php

namespace App\Controllers;

use App\Models\Currency;
use App\Models\Rate;

class Home extends \App\Controllers\Base {
	public function index($request, $response, $args) {
		// Sample log message
		$this->logger->info('Slim-Skeleton \'/\' route');
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

	public function page($request, $response, $args) {
		return $this->renderer->render($response, 'page', $args);
	}

	public function evolution($request, $response, $args) {
		return $this->renderer->render($response, 'evolution', $args);
	}

	public function convertor($request, $response, $args) {
		return $this->renderer->render($response, 'converter', $args);
	}
}
