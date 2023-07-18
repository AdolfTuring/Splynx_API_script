<?php
include 'SplynxApi.php';
$api_url = 'http://domain/'; // please set your Splynx URL
#$admin_login = 'login';
#$admin_password = 'password';
$api = new SplynxApi($api_url);
$api->setVersion(SplynxApi::API_VERSION_2);
$api->login([
    'auth_type' => SplynxApi::AUTH_TYPE_API_KEY,
    'key' => 'key',
    'secret' => 'secret',
]);

$log_file = 'import_log.txt';

$urlCustom = "admin/networking/cpe";


//file to array
$csv = array_map('str_getcsv', file('import.csv')); //csv-file to array
//print_r($csv);

foreach ($csv as $file) {
    
        
    
        $data_array = [
            'api_password' => $file[1],
            
        ];
        //update internet-services for customer
        $result = $api->api_call_put($urlCustom.'/'.$file[0], '', $data_array);

        if ($result) {
            file_put_contents($log_file, "CPE {$file[0]} updated\n", FILE_APPEND);
      
        } else {
            file_put_contents($log_file, "CPE {$file[0]} NOT updated, {$api->response_code}\n", FILE_APPEND);
          
      

    }
}

?>