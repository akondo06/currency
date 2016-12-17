<?php

if(!function_exists('roDate')) {
	function roDate($date, $format='default') {

		$formats = [
			'default' => 'd.m.Y',
			'long' => 'd F Y'
		];

		if(array_key_exists($format, $formats)) {
			$format = $formats[$format];
		}

		$months = [
			'January' => 'Ianuarie',
			'February' => 'Februarie',
			'March' => 'Martie',
			'April' => 'Aprilie',
			'May' => 'Mai',
			'June' => 'Iunie',
			'July' => 'Iulie',
			'August' => 'August',
			'September' => 'Septembrie',
			'October' => 'Octombrie',
			'November' => 'Noiembrie',
			'December' => 'Decembrie'
		];
		$monthNos = [
			'january' => 1,
			'february' => 2,
			'march' => 3,
			'april' => 4,
			'may' => 5,
			'june' => 6,
			'july' => 7,
			'august' => 8,
			'september' => 9,
			'october' => 10,
			'november' => 11,
			'december' => 12
		];

		// cases: year-month-day, Day Month Year

		$date = str_replace(' ', '-', strtolower($date));
		$date = explode('-', $date);

		$year = $date[0];
		$month = $date[1];
		$day = $date[2];

		if(strlen($year) !== 4) {
			$day = $date[0];
			$year = $date[2];
		}

		if(strlen($month) > 2) {
			$month = $monthNos[$month];
		}
		$month = intval($month);
		if($month < 9) {
			$month = '0'.$month;
		}

		$result = new \DateTime($year.'-'.$month.'-'.$day);
		$result = $result->format($format);

		foreach($months as $en => $ro) {
			$result = str_replace($en, $ro, $result);
		}

		return $result;
	}
}
