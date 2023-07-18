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

        // for geting checklists for all tasks
    $params = [
    'limit' => 2,
    'offset' => 1,
];

        $api->api_call_get("admin/config/scheduling-task-templates".'?'. http_build_query($params));
?>


