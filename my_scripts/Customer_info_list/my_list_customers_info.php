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

$result_file = 'result_list.txt';
        // for geting checklists for all tasks
    $params = [
    'limit' => 2,
    'offset' => 0,
];

        //$api->api_call_get("admin/customers/customer-info".'?'. http_build_query($params));
        $result = $api->api_call_get("admin/customers/customer-info/1");
        echo gettype($result);
        //print_r(array_values($result));
        //file_put_contents($result_file, "$result\n", FILE_APPEND);
?>


