<?php
include 'SplynxApi.php';
$api_url = 'https://domain/'; // please set your Splynx URL
$admin_login = 'splynx';
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
$csv = array_map('str_getcsv', file('ip.csv')); //csv-file to array
//print_r($csv);

foreach ($csv as $file) {
    
        
    
        $data_array = [
            #'taking_ipv4' => '1',
            'ipv4' => $file[2]
        ];
        //update internet-services for customer
        $result = $api->api_call_put($urlCustom.'/'.$file[0].'/internet-services--'.$file[1], '', $data_array);
    
        if ($result) {
            file_put_contents($log_file, "Customer's {$file[0]} service ID:{$file[1]} updated, IP {$file[2]}\n", FILE_APPEND);
      
        } else {
            file_put_contents($log_file, "ERROR! Customer's {$file[0]} service ID:{$file[1]} NOT updated, IP {$file[2]}, {$api->response_code}\n", FILE_APPEND);
          
      

    }
}

?>