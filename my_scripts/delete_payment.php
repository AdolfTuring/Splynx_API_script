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
 $data_array = [
            "customer_id"=> "1",
            #"credit_note_id"=> "33",
            "request_id" => "2",
            "payment_type"=> "1",
            "receipt_number"=> "2023-01-000346",
            "date"=> "2023-06-23",
            "amount"=> 10,
            "remind_amount"=> "0.0000",
            "comment"=> "Refund",
            "field_1"=> "",
            "field_2"=> "",
            "field_3"=> "",
            "field_4"=> "",
            "field_5"=> ""
                        
];
#$api->api_call_delete("admin/finance/payments/72",'',);
#$api->api_call_get("admin/finance/payments/76");
$api->api_call_post("admin/finance/payments", $data_array);
?>


