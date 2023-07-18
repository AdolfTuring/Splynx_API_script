<?php
include 'SplynxApi.php';
$api_url = 'https://domain/'; // please set your Splynx URL
$admin_login = 'admin';
$admin_password = 'pass';
$api = new SplynxApi($api_url);
$api->setVersion(SplynxApi::API_VERSION_2);
$api->login([
    'auth_type' => SplynxApi::AUTH_TYPE_ADMIN,
    'login' => $admin_login,
    'password' => $admin_password,
]);


$ApiAllServices = "admin/customers/customer/0/internet-services";

$urlCustom = "admin/customers/customer";

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
$csv = array_map('str_getcsv', file('test.csv')); //csv-file to array
//print_r($csv);

foreach ($csv as $file) {
    $key = array_search($file[0], array_column($internet_services, 'customer_id'));

    if (!empty($key)) {
        $data_array = array(
            //'router_id' => 89,
            //'taking_ipv4' => 1,
            'start_date' => $file[2]
        );
        //update internet-services for customer
        $result = $api->api_call_put($urlCustom.'/'.$file[1].'/internet-services--'.$file[0], '', $data_array);
        if ($result) {
            print_r("Service {$file[0]} updated, IP {$file[2]}\n");
        } else {
            print_r("Service {$file[0]} NOT updated, IP {$file[2]}, {$api->response_code}\n");
        }

    }
}
