<?php
include '../admin_tasks/splynx_api/src/SplynxApi.php'; // API source

$server = "";
$api = new SplynxApi($server);
$api->setVersion(SplynxApi::API_VERSION_2);
$api->login([
    'auth_type'=> SplynxApi::AUTH_TYPE_API_KEY,
    'key' => '',
    'secret' => '',
]);


$log_file = 'log.txt';
$i=0;
$csv = array_map('str_getcsv', file('../cosot.csv')); //csv-file to array
$api->api_call_get('admin/customers/customer');
$customers = $api->response;

//print_r($csv);

foreach ($csv as $file) {
    $key = array_search($file[0], array_column($customers, 'login'));
    $invoice = [
        'customer_id' => $customers[$key]['id'],
        'date_created' => '2020-01-15',
        'status' => 'not_paid',
        'number' => $file[1],
        'items' => [
            '0' => [
                'description' => 'Cargo Por Demora',
                'quantity' => 1,
                'unit' => 1,
                'price' => 5,
                'tax' => 11.50,
                //'categoryIdForTransaction' => 5
            ]
        ]];
    $result = $api->api_call_post("admin/finance/invoices", $invoice);
    if ($result) {
        $i++;
        file_put_contents($log_file, "Invoice {$file[1]} created for customer {$file[0]},   all created {$i}\n", FILE_APPEND);
    } else {
        file_put_contents($log_file, "Invoice {$file[1]} NOT created for customer {$file[0]} \n", FILE_APPEND);
    }
}
