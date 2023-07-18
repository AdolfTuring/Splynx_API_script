<?php
include 'SplynxApi.php';
$api_url = 'https://domain/'; // please set your Splynx URL
$admin_login = 'splynx';
$admin_password = 'pass';
$api = new SplynxApi($api_url);
$api->setVersion(SplynxApi::API_VERSION_2);
$api->login([
    'auth_type' => SplynxApi::AUTH_TYPE_ADMIN,
    'login' => $admin_login,
    'password' => $admin_password,
]);

$log_file = 'import_log.txt';

$ApiAllServices = "admin/customers/customer/0/internet-services";

$urlCustom = "admin/customers/customer";

//$log_file = 'log_ZTEL.txt'; //log file


//get all services
$data = [
    'main_attributes' => [
        'status' => 'active',
        //'ipv4_pool_id' => 91
    ]
];

$result = $api->api_call_get($ApiAllServices.'?'.http_build_query($data));
$internet_services = $api->response;
//print_r($internet_services);


//file to array
$csv = array_map('str_getcsv', file('source.csv')); //csv-file to array
//print_r($csv);

foreach ($csv as $file) {
    $key = array_search($file[1], array_column($internet_services, 'id'));

    if (!empty($key)) {
        $data_array = array(
            //'router_id' => 89,
            'taking_ipv4' => 1,
            'ipv4' => $file[9]
        );
        //update internet-services for customer
        $result = $api->api_call_put($urlCustom.'/'.$file[0].'/internet-services--'.$file[1], '', $data_array);
        if ($result) {
            file_put_contents($log_file, "Service {$file[1]} updated, IP {$file[9]}\n", FILE_APPEND);
      
        } else {
            file_put_contents($log_file, "Service {$file[1]} NOT updated, IP {$file[9]}, {$api->response_code}\n", FILE_APPEND);
          
        }

    }
}

?>