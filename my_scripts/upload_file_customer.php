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
        $cf=new \CURLFile("some.txt");
        $data_array = [
        'file' => $cf,
        ];

        $api->api_call_post_file("admin/customers/customer-documents/4--upload",$data_array);
?>


 
 