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


		$base_rate = $session->get('index_currency');
		$args['rate'] = Currency::where('currency', $base_rate)->first();
		// $args['rateValues'] = Rate::whereDate('published_on', '<=', $args['index_date'])->groupBy('currency')->orderBy('published_on', 'desc')->getEquivalentValue($base_rate, 1, null, [$base_rate]);
		// $args['rateValues'] = Rate::getEquivalentValue($base_rate, 1, null, [$base_rate]);
		$args['queries'] = Rate::onDate('2016-11-17')->getEquivalentValue('RON', 1, null, ['RON'])->toSql();

		// Render index view
		return $this->renderer->render($response, 'home', $args);
	}

	public function page($request, $response, $args) {
		return $this->renderer->render($response, 'page', $args);
	}
}
