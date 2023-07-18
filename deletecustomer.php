<?php
include 'SplynxApi.php';
$api_url = 'https://splynxtest.hopto.org/'; // please set your Splynx URL
$admin_login = 'admin';
$admin_password = 'q1w2e3r4t5';
$api = new SplynxApi($api_url);
$api->setVersion(SplynxApi::API_VERSION_2);
$api->login([
    'auth_type' => SplynxApi::AUTH_TYPE_ADMIN,
    'login' => $admin_login,
    'password' => $admin_password,
]);

        $api->api_call_delete("admin/customers/customer/194", '',);
?>