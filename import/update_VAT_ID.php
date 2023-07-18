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

$log_file = 'import_log.txt';

$ApiAllServices = "admin/customers/customer/0/internet-services";

$urlCustom = "admin/customers/customer-info";


//file to array
$csv = array_map('str_getcsv', file('Vat_import.csv')); //csv-file to array
//print_r($csv);

foreach ($csv as $file) {
    
        
    
        $data_array = array(
            'vat_id' => $file[1]
        );
        //update internet-services for customer
        $result = $api->api_call_put($urlCustom.'/'.$file[0], '', $data_array);

        if ($result) {
            file_put_contents($log_file, "Customer {$file[0]} updated, VAT {$file[1]}\n", FILE_APPEND);
      
        } else {
            file_put_contents($log_file, "Customer {$file[0]} NOT updated, VAT {$file[1]}, {$api->response_code}\n", FILE_APPEND);
          
      

    }
}

?>