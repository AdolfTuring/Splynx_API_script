<?php
include 'SplynxApi.php';
$api_url = 'https://domain/'; // please set your Splynx URL
$admin_login = 'admin';
$admin_password = 'Pass';
$api = new SplynxApi($api_url);
$api->setVersion(SplynxApi::API_VERSION_2);
$api->login([
    'auth_type' => SplynxApi::AUTH_TYPE_ADMIN,
    'login' => $admin_login,
    'password' => $admin_password,
]);

        $data_array = [
            "additional_attributes"=> [
        
                "splynx_addon_agents_agent" => "",
        
        ]];

        $api->api_call_put("admin/customers/customer/1609", '', $data_array);
?>


