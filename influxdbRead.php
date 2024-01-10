<?php
use InfluxDB2\Model\WritePrecision;

require __DIR__ . '/vendor/autoload.php';

# You can generate a Token from the "Tokens Tab" in the UI
$token = 'h6j7YA5IQtplqoIE1Uu_GY1jhczgMGgvFcnD_3A4GYw18prd1Zn_2WZN_JarVumkV6Qr5x7w-KtE-Du8VgORSA=='; # your token here
$org = 'org';
$bucket = 'opticore-api';

$client = new InfluxDB2\Client([
	"url" => "http://localhost:8086", // url and port of your instance
	"token" => $token,
]);

$queryApi = $client->createQueryApi();
$query = "from(bucket: \"$bucket\")
	|> range(start: -12h)
	|> filter(fn: (r) => r._measurement == \"temp_c\")";

$tables = $queryApi->query($query, $org);

echo count($tables[0]->columns);    // Number of points

$records = [];
foreach ($tables as $table) {
	foreach ($table->records as $record) {
    	// because we will have multiple fields at the same second in time, we need to merge the data into a single array after we query it out
    	$row = key_exists($record->getTime(), $records) ? $records[$record->getTime()] : [];
    	$records[$record->getTime()] = array_merge($row, [$record->getField() => $record->getValue()]);
	}
}

// echo var_dump($records);