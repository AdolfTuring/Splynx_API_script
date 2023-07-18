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
        
  "customer_id"=>"1",
  "tariff_id"=>"3",
  "status"=>"active",
  "description"=> "Some Description",
  "quantity"=> "1",
  "unit"=> "0",
  "unit_price"=> "0",
  "start_date"=> "2016-01-01",
  "end_date"=> "0000-00-00",
  "discount"=> "0",
  "discount_type"=> "percent",
  "discount_value"=> "0",
  "discount_start_date"=> "",
  "discount_end_date"=> "",
  "discount_text"=> "",
  "router_id"=> "0",
  "sector_id"=> "0",
  "login"=>"qwerty",
  "password"=> "",
  "taking_ipv4"=> "0",
  "ipv4"=> "",
  "ipv4_route"=> "",
  "ipv4_pool_id"=> "0",
  "ipv6"=> "",
  "ipv6_delegated"=> "",
  "mac"=> "",
  "port_id"=> "0"

        ];

       



        $api->api_call_post("admin/customers/customer/1/internet-services", $data_array);
?>