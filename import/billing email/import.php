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

$urlCustom = "admin/customers/customer";


//file to array
$csv = array_map('str_getcsv', file('import.csv')); //csv-file to array
//print_r($csv);

foreach ($csv as $file) {
    
        
    
        $data_array = [
            'billing_email' => $file[2]

        ];
        //update internet-services for customer
        $result = $api->api_call_put($urlCustom.'/'.$file[0], '', $data_array);

        if ($result) {
            file_put_contents($log_file, "Customer {$file[0]} updated\n", FILE_APPEND);
      
        } else {
            file_put_contents($log_file, "Customer {$file[0]} NOT updated, {$api->response_code}\n", FILE_APPEND);
          
      

    }
}

?>
