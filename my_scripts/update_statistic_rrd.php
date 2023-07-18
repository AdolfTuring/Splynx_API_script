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
    
    "download" => 4600,
    "upload" => 2040,
    "time" => 280,
    "interval" => 300,
];
        $api->api_call_post("admin/customers/customer-internet-services-rrd/1--1",$params);
?>


