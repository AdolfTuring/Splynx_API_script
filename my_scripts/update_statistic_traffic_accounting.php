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

$params = [
    
    "download" => 10000,
    "upload" => 10000,
    "time" => 300,
    #"interval" => 300,
];
        $api->api_call_put("admin/networking/traffic-accounting/67", '',$params);
?>


