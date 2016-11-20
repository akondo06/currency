<?php

if(!function_exists('previousWeekDay')) {
	function previousWeekDay($date = null, $format = 'Y-m-d') {
		$date = new \DateTime($date);
		$date_final = $date->format($format);

		while((date('N', strtotime($date_final)) >= 6)) {
			$date->sub(\DateInterval::createFromDateString('1 day'));
			$date_final = $date->format($format);
		}

		return $date_final;
	}
}
