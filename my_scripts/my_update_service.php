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
       $data_array = [
        'description' => '12345',
            "additional_attributes"=> [
        
                "cus" => "123",
        
        ]];

        $api->api_call_put("admin/customers/customer/1/internet-services--1", '', $data_array);
?>


