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
       $data_array = [
        'login' => 'test',
        'name' => 'API_test',
        'password' => '12345678',
        'partner_id' => '1',
        'location_id' => '1',
        'category' => 'person'
        ];

        $api->api_call_post("admin/customers/customer/", $data_array);
?>


