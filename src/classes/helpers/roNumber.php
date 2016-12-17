<?php

if(!function_exists('roNumber')) {
	function roNumber($number, $precision = 4, $decPoint = ',', $thousandsSeparator = '.') { // Romanian separators and decimal point
		return number_format(floatval($number), $precision, $decPoint, $thousandsSeparator);
	}
}
