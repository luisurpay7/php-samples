<?php
// $url = "http://localhost:1883/usuarios";
$url = "http://localhost:1883/postman";


$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
// curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// $data = <<<DATA
// {
//   "Id": 78912,
//   "Customer": "Jason Sweet",
//   "Quantity": 1,
//   "Price": 18.00
// }
// DATA;

// curl_setopt($curl, CURLOPT_POSTFIELDS, 1);

$resp = curl_exec($curl);
curl_close($curl);

echo $resp;
?>