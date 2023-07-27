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
        // create a file
        $data_array = [
        "customer_id"=>1,
        "type"=> "uploaded",
        "title"=> "customer document title",
        "description"=> "document description",
        "visible_by_customer"=> "0"
        ];

        $result=$api->api_call_post("admin/customers/customer-documents",$data_array);
        $key=$api->response;
        $id = $key['id'];
        //echo gettype($id);
        //echo $key;
       
        // upload file
        $cf=new \CURLFile("some.pdf");
        $data_array = [
        'file' => $cf,
        ];

        $api->api_call_post_file("admin/customers/customer-documents/".$id."--upload",$data_array);
?>


 
 