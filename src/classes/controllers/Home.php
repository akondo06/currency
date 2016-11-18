<?php

namespace App\Controllers;

use App\Models\Currency;
use App\Models\Rate;

class Home extends \App\Controllers\Base {
	public function index($request, $response, $args) {
		// Sample log message
		$this->logger->info('Slim-Skeleton \'/\' route');

		// $args['rates'] = Currency::where('currency', 'RON')->get()->values();
		// $args['rates'] = Rate::where('published_on', '2016-11-04')->get();
		// $args['rates'] = Rate::getEquivalentValue('RON', 4, ['EUR', 'USD', 'RON', 'DKK']);  // DIN RO in EUR, USD, RON, DKK ... 
		// $args['rates'] = Rate::getEquivalentValue('EUR', 1, ['EUR', 'USD', 'RON', 'DKK']); // DIN EUR in RO

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


		if($session->get('index_date') == null) {
			$session->set('index_date', date('Y-m-d'));
		}
		if($session->get('index_currency') == null) {
			$session->set('index_currency', 'RON');
		}

		$args['index_date'] = $session->get('index_date');
		$args['index_currency'] = $session->get('index_currency');

		// $index_date = new \DateTime($args['index_date']);
		// $index_date_final = $index_date->format('Y-m-d');

		// while((date('N', strtotime($index_date_final)) >= 6)) {
		// 	$index_date->sub(\DateInterval::createFromDateString('1 day'));
		// 	$index_date_final = $index_date->format('Y-m-d');
		// }

		// $index_date = $index_date_final;

		$args['que'] = json_encode($args);

		$index_currency = $session->get('index_currency');
		$args['currency'] = Currency::where('currency', $index_currency)->first();
		$args['rates'] = Rate::onDate($args['index_date'])->orderBy('currency', 'desc')->getEquivalentValues($index_currency, 1, null, [$index_currency]);

		// Render index view
		return $this->renderer->render($response, 'home', $args);
	}

	public function page($request, $response, $args) {
		return $this->renderer->render($response, 'page', $args);
	}
}
