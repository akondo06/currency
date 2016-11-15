<?php

// Latest ...
$url = "http://www.bnr.ro/nbrfxrates.xml";
// All 2016
$url = "http://www.bnr.ro/files/xml/years/nbrfxrates2016.xml";

echo "Getting file....{$url}\n";

$response = file_get_contents($url);
echo "Got it. Parsing....\n";

$xml = simplexml_load_string($response) or die("Could not get the rates file!");


echo "Base currency: {$xml->Body->OrigCurrency}\n\n";
$days = []; 

foreach($xml->Body->Cube as $xmlDay) {
	$day = (object) ['date' => (string) $xmlDay['date'], 'rates' => []];
	foreach($xmlDay->children() as $rate) {
		$currency = (string) $rate['currency'];
		$value = (float) $rate;
		$multiplier = (int) $rate['multiplier'];
		if($multiplier == 0) {
			$multiplier = 1;
		}
		$day->rates[] = (object) ['currency' => $currency, 'value' => $value, 'multiplier' => $multiplier];
	}
	$days[] = $day;
}

foreach($days as $day) {
	echo "Day {$day->date}:\n \t";
	foreach($day->rates as $rate) {
		echo "{$rate->currency}={$rate->value}({$rate->multiplier}), ";
	}
	echo "\n";
}

echo "Done!\n";
echo "Got ".count($days)." days!\n";
exit;
