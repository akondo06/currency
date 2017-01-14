<?php
use App\Models\Rate;

if(!function_exists('ratesOnDate')) {
	function ratesOnDate($date=null, $order='asc') {
		if($date == null) {
			$date = Rate::latestDate();
		}
		return Rate::onDate($date, $order)->getEquivalentValues('RON', 1, ['EUR', 'GBP', 'USD'], null, true);
	}
}