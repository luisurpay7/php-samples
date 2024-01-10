<?php

// composer require influxdata/influxdb-client-php
// composer require php-http/curl-client guzzlehttp/psr7 php-http/message

use InfluxDB2\Model\WritePrecision;

require __DIR__ . '/vendor/autoload.php';

# You can generate a Token from the "Tokens Tab" in the UI

// $token = 'h6j7YA5IQtplqoIE1Uu_GY1jhczgMGgvFcnD_3A4GYw18prd1Zn_2WZN_JarVumkV6Qr5x7w-KtE-Du8VgORSA=='; # your token here
// $org = 'org';
// $bucket = 'opticore-api';
// $url = 'http://localhost:8086';

$token = 'my-super-secret-auth-token'; # your token here
$org = 'win-org';
$bucket = 'test-db';
// $url = 'http://localhost:8086';
// $url = 'http://172.24.0.4:8086';
$url = 'http://172.24.0.9:8086';

$initTime = new DateTime(null, new DateTimeZone('America/Lima'));
echo "1-";

$client = new InfluxDB2\Client([
	"url" => $url, // url and port of your instance
	"token" => $token,
	"timeout" => 1,
]);
echo "3-";

// The base data we will be inserting
$rawData = [
	["temp" => 8, 'humidity' => .57],
	["temp" => 8, 'humidity' => .59],
	["temp" => 7, 'humidity' => .60],
	["temp" => 7, 'humidity' => .58],
	["temp" => 7, 'humidity' => .54],
	["temp" => 9, 'humidity' => .53],
	["temp" => 10, 'humidity' => .55],
	["temp" => 10, 'humidity' => .59],
	["temp" => 11, 'humidity' => .60],
];

echo "4-";
$writeApi = $client->createWriteApi();
$writeApi = $client->createWriteApi(["retryInterval" => 0, "maxRetries" => 0, "maxRetryDelay" => 0, "maxRetryTime" => 0]);

// sin maxRetryTime			/2min
// maxRetryTime => 3000		/21 seg
// maxRetryTime => 1000		/21 seg



foreach ($rawData as $index => $datum) {
	$dataArray = [
    	'name' => 'temp_c',
    	'tags' => ['location' => 'Melbourne'],
    	'fields' => ['degrees' => $datum['temp'], 'humidity' => $datum['humidity']],
    	// 'time' => microtime(true) - (7200 * $index), // we will populate data going back by the hour
    	// 'time' => microtime(true), // we will populate data going back by the hour
		'time' => new DateTime(null, new DateTimeZone('America/Lima'))
	
	];

	// $dataArray = ['name' => 'cpu', 
    // 'tags' => ['host' => 'server_nl', 'region' => 'us'],
    // 'fields' => ['internal' => 5, 'external' => 6],
    // // 'time' => microtime(true)
	// ];

	echo "-FOR-";
	$writeApi->write($dataArray, WritePrecision::NS, $bucket, $org);
	exit("FIN");
}

$endTime = new DateTime(null, new DateTimeZone('America/Lima'));

echo var_dump($initTime);
echo var_dump($endTime);

// echo $initTime->date;

