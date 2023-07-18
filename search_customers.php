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
$data = [
    'main_attributes' => [
        'status' => ['IN', ['active', 'blocked', 'pending', 'stopped']]
    ]
];
$AllServices = "admin/customers/customer/0/internet-services";
$result = $api->api_call_get($AllServices.'?'.http_build_query($data));
$internet_services = $api->response;
//print_r($internet_services);
$file_services = "/home/yless4u/csv/internet_services.csv";
$fp = fopen("{$file_services}", 'w');
fputcsv($fp, ['plan','IP','login']); //write array keys to file

foreach ($internet_services as $service) {
    fwrite($fp, implode(',', [$service['description'], $service['ipv4'], $service['login'], "\n"]));
}

$tariffs = "admin/tariffs/internet";
$result = $api->api_call_get($tariffs);
$tariff_plans = $api->response;
$file_tariffs = "/home/yless4u/csv/tariffs.csv";
$fp = fopen("{$file_tariffs}", 'w');
fputcsv($fp, ['title' ,'ID','speed_download','speed_upload']); //write array keys to file

foreach ($tariff_plans as $plan) {
    fputcsv($fp, [$plan['title'],$plan['id'], $plan['speed_download'], $plan['speed_upload']]);
}

?>


