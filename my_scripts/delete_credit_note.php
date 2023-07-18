#!/usr/bin/php
<?php
include 'SplynxApi.php';
$api_url = 'http://domain/'; // please set your Splynx URL
$admin_login = 'admin';
$admin_password = 'pass';
$api = new SplynxApi($api_url);
$api->setVersion(SplynxApi::API_VERSION_2);
$api->login([
    'auth_type' => SplynxApi::AUTH_TYPE_ADMIN,
    'login' => $admin_login,
    'password' => $admin_password,
]);

$api->api_call_delete("admin/finance/credit-notes/2");
?>


