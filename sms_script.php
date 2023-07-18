<?php

// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP array
$data = json_decode($json, true);

if (strpos($data['to'], '+') !== false) {
    $data['to'] = str_replace('+', '00', $data['to']);
}

$postdata = '{"messages": {"authentication": {"producttoken": "bb8d890d-a22c-4618-abcb-6b9272533181"},"msg": [ {"allowedChannels":  ["SMS"],"from": "'.$data['from'].'","to": [{"number": "'.$data['to'].'"}],"minimumNumberOfMessageParts": 1, "maximumNumberOfMessageParts": 8,"body": {"content": "' . $data['message'] .'"}}]}}';

$ch = curl_init("https://gw.cmtelecom.co.za/v1.0/message");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
$result = curl_exec($ch);
curl_close($ch);
print_r ($result);

$log_file = "/var/www/splynx/logs/cron/sms.log";

file_put_contents($log_file, "Sending SMS to {$data['to']} at: ".date("Y-m-d H:i:s")."\n", FILE_APPEND);
file_put_contents($log_file, print_r($data, TRUE), FILE_APPEND);
file_put_contents($log_file, "RESPONSE:"."\n", FILE_APPEND);
file_put_contents($log_file, print_r($result, TRUE), FILE_APPEND);
file_put_contents($log_file, "\n", FILE_APPEND);
// {"from": "%PARTNER%", "to": "%TO%", "message": "%MESSAGE%"}

/*
 *
 */
