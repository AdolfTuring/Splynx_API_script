<?php
include 'SplynxApi.php';
$api_url = 'https://domain/'; // please set your Splynx URL
$admin_login = 'XXX';
$admin_password = 'XXX';
$api = new SplynxApi($api_url);
$api->setVersion(SplynxApi::API_VERSION_2);
$api->login([
    'auth_type' => SplynxApi::AUTH_TYPE_API_KEY,
    'key' => 'XXX',
    'secret' => 'XXX',
]);

$params = [
    
    'download'=> 40960000,
    'upload'=> 20480000,
    'time'=> 200,
    


];
        $api->api_call_put("admin/networking/traffic-accounting/93",'',$params);
?>


