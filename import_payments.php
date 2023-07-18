<?php
include 'splynx_api/src/SplynxApi.php'; // API source

$server = "";
$api = new SplynxApi($server);
$api->setVersion(SplynxApi::API_VERSION_2);
$api->login([
    'auth_type'=> SplynxApi::AUTH_TYPE_ADMIN,
    'login' => '',
    'password' => '',
]);

$log_file = 'log_payment_import.txt';
$csv = array_map('str_getcsv', file('../temp.csv')); //csv-file to array


foreach ($csv as $file) {
        $payment = [
            'payment_type' => 3,
            'customer_id' => $file[4],
            'invoice_id' => $file[5],
            'receipt_number' => $file[0],
            'date' => "2022-05-02",
            'amount' => $file[3],
            'comment' => "imported by Splynx"
        ];

        $api->api_call_post('admin/finance/payments', $payment);
        $result = $api->response;

        if ($result) {
            file_put_contents($log_file, "++ Customer {$file[4]}, payment: {$file[3]}, transaction ID: {$file[0]}\n", FILE_APPEND);
        } else {
            file_put_contents($log_file, "-- Customer {$file[4]}, payment: {$file[3]}, transaction ID: {$file[0]}\n", FILE_APPEND);
        }
    }