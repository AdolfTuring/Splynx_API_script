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
     'incoming_customer_id' => 1,
    'type_id'=> 1,
    'subject'=> 'Test_scrip',
    'priority'=> 'medium',


];
        $api->api_call_post("admin/support/tickets",$params);
?>


