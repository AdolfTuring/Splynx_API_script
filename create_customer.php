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
        "name" => "Djohn doe",
        "partner_id"=> "1",
        "location_id"=> "1",
        "category"=> "person",  
        "billing_type"=> "prepaid_monthly",
        ];

       



        $api->api_call_post("admin/customers/customer/", $data_array);
?>