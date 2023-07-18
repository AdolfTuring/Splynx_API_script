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

$params = array(
    'main_attributes' => array (
        'status' => 'new',
    ),
    'order' => array (
        'id' => 'DESC',
    ),
    'limit' => 1,
);
//Get customer's info
$api->api_call_get("admin/customers/customer".'?'. http_build_query($params));
$customer=$api->response;
//print_r($customer);

$cusLocID=$customer[0]['location_id'];
$cusID=$customer[0]['id'];
//print $cusLocID;

//Get location name
$api->api_call_get("admin/administration/locations/$cusLocID", '', );
$location=$api->response;
$location=$location['name'];
$location=strtoupper($location) ; 
$location=substr($location, 0, 4);
print $location;

//Code generation
$emptyID="00000";
$len=strlen($cusID);
$emptyID=substr($emptyID, 0,-($len));
$generatedValue="MY-".$location."-".$emptyID.$cusID;

        $data_array = [
            "additional_attributes"=> [
        
                "generated_code" => "$generatedValue",
        
        ]];

        $api->api_call_put("admin/customers/customer/$cusID", '', $data_array);
       
?>


