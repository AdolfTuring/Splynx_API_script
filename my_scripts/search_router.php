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

$params = [
    'partners_ids' => ['IN', [3]],

;
//Get customer's info
$api->api_call_get("admin/networking/routers".'?'. http_build_query($params));
$customer=$api->response;
//print_r($customer);
//print_r("admin/customers/customer".'?'. http_build_query($params));
//$cusID=$customer[0]['id'];
//Get billing's info
//$api->api_call_get("admin/customers/billing-info/$cusID?format_values=true");
?>


