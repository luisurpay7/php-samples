<?php

$accountID = '6125688-sb1';
$realm = "6125688_SB1";
$ckey = "515343a0dd921d8a4d791e4c820f24d0846abb5f4085833e9355514a70b98cdc"; //Consumer Key
$csecret = "66ccc8023769bc6720997f74be1474e33ec2d1c9015f5fe199f4bfd3f9c97d09"; //Consumer Secret
$tkey = "4f85ec1fd6a9ce3a64d7e95e374d9666ff5df7266734843381a33865c03f8b3c"; //Token ID
$tsecret = "b8c97c45dfa261017d6d1ae136729146c4adb7f0d600e0397c9ff24ec9d00b92"; //Token Secret

$url = 'https://'.$accountID.'.suitetalk.api.netsuite.com/services/rest/record/v1/invoice';
$httpMethod ="POST";

$body = '{
    "externalid": "F002-00001923",  
    
    "tranId": "WINET-FA-F002-00001923",
    
    "entity": {                 
        "id": "135045"
    },
    "tranDate": "2024-1-25",    
    "memo": "Registro de factura desde PHP",   
    "subsidiary": "3",          
    "department": "5",         
    "class": "18",               
    "location": "92",           

    "custbody_pe_document_type": "55",  
    "custbody_pe_serie": "42",  
    "custbody_pe_number": "1923",    
    "custbody_pe_ei_operation_type": "101", 
    "custbody_pe_free_operation": false,  
    "custbody_pe_ei_forma_pago": "1",   
    
    "account": "730",       
    "exchangerate": 1,    
    "currency": "1",        
    "item": {
        "items": [
            {
                "item": {
                    "id": 1084
                },
                "quantity": 1,      
                "rate": 44.00,    
                "grossamt": 51.92,      
                "taxcode": "6",     
                "units": "38",      
                "department": "52",
                "class": "16",
                "location": "302"
            },
            {
                "item": {
                    "id": 1089
                },
                "quantity": 1,      
                "rate": 77.00,    
                "grossamt": 90.86,      
                "taxcode": "6",     
                "units": "38",      
                "department": "52",
                "class": "16",
                "location": "302"
            }
        ]
    }
}';

// Get Authorization Header
$timestamp= time();
$nonce= uniqid(mt_rand(1, 1000));
$baseString = $httpMethod . '&' . rawurlencode($url) . "&"
    . rawurlencode("oauth_consumer_key=" . rawurlencode($ckey)
        . "&oauth_nonce=" . rawurlencode($nonce)
        . "&oauth_signature_method=HMAC-SHA256"
        . "&oauth_timestamp=" . rawurlencode($timestamp)
        . "&oauth_token=" . rawurlencode($tkey)
        . "&oauth_version=1.0"
    );
$key = rawurlencode($csecret) . '&' . rawurlencode($tsecret);

$signature = rawurlencode(base64_encode(hash_hmac('sha256', $baseString, $key, true)));

$header = array(
    "Content-Type: application/json",
    "Authorization: OAuth realm=\"$realm\", oauth_consumer_key=\"$ckey\", oauth_token=\"$tkey\", oauth_nonce=\"$nonce\", oauth_timestamp=\"$timestamp\", oauth_signature_method=\"HMAC-SHA256\", oauth_version=\"1.0\", oauth_signature=\"$signature\"",
);

// Make HTTP request
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:84.0) Gecko/20100101 Firefox/84.0',
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => $httpMethod,
    CURLOPT_POSTFIELDS => $body,
    CURLOPT_HTTPHEADER => $header,
));

$response = curl_exec($curl);

curl_close($curl);

// Print Response
header('Content-type: application/json');
echo $response;

?>