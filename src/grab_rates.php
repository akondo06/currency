<?php

$current_year = date('Y');

$url = "http://www.bnr.ro/files/xml/years/nbrfxrates{$current_year}.xml"; // available from 2005 and up!

$db = (object) [
	'host' => 'localhost',
	'username' => 'root',
	'password' => null,
	'database' => 'currency'
];

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

// foreach($days as $day) {
// 	echo "Day {$day->date}:\n \t";
// 	foreach($day->rates as $rate) {
// 		echo "{$rate->currency}={$rate->value}({$rate->multiplier}), ";
// 	}
// 	echo "\n";
// }
echo "Got ".count($days)." days with a total of ".count($days) * count($days[0]->rates)." rates!\n";

if($db == null) {
	exit('NO DB INFO!');
}

$mysqli = new mysqli($db->host, $db->username, $db->password, $db->database);
if($mysqli->connect_errno) {
    echo "Error: Failed to make a MySQL connection, here is why: \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";
    exit;
}

// $result = $mysqli->query($sql)

foreach($days as $day) {
	// echo "Inserting Day {$day->date}:\n";
	$statement = "INSERT IGNORE INTO `rate_values`(`published_on`, `currency`, `value`) VALUES";
	$values = [];
	foreach($day->rates as $rate) {
		$values[] = "('{$day->date}', '{$rate->currency}', '{$rate->value}')";
	}
	$statement .= implode(', ', $values);
	$statement .= ';';
	if(!$result = $mysqli->query($statement)) {
		exit("Failed at day {$day->date} .. no idea why! \n\n {$statement} \n\n {$mysqli->error} \n\n");
	}
}

$mysqli->close();
echo "Inserted in Database!\n";
echo "Done!\n";
exit;
