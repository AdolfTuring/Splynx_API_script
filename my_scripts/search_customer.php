#!/usr/bin/php
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

$params = [ 'main_attributes' => [
        'status' => ['IN', ['active', 'blocked']],
    ],
    'limit' => 2,
    ];
     
//Get customer's info
$api->api_call_get("admin/customers/customer?". http_build_query($params));

?>
