<?php
include 'SplynxApi.php';
$api_url = 'http://domain/'; // please set your Splynx URL
#$admin_login = 'admin';
#$admin_password = 'pass';
$api = new SplynxApi($api_url);
$api->setVersion(SplynxApi::API_VERSION_2);
$api->login([
    'auth_type' => SplynxApi::AUTH_TYPE_API_KEY,
    'key' => 'key',
    'secret' => 'secret',
]);

$cpe_id='1';
$data_array = [
         "date_till"=> "2023-07-19",
        ];
     
        #$api->api_call_put("admin/networking/cpe/1", '', $data_array);
        $api->api_call_get("admin/finance/invoices/176");
        //$api->api_call_get("admin/networking/cpe/1");

?>

