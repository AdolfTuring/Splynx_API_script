<?php
include 'SplynxApi.php';
$api_url = 'https://domain/'; // please set your Splynx URL
$admin_login = 'admin';
$admin_password = 'pass';
$api = new SplynxApi($api_url);
$api->setVersion(SplynxApi::API_VERSION_2);
$api->login([
    'auth_type' => SplynxApi::AUTH_TYPE_API_KEY,
    'key' => 'key',
    'secret' => 'secret',
]);

$log_file = 'import_log.txt';

$urlCustom = "admin/finance/invoices";


//file to array
$csv = array_map('str_getcsv', file('invoice.csv')); //csv-file to array
//print_r($csv);

foreach ($csv as $file) {
    
        
    
        $data_array = [
        'customer_id' => $file[0],
        'date_created' => $file[4],
        'status' => 'not_paid',
        'number' => $file[2],
        'items' => [
            '0' => [
                'description' => $file[1],
                'quantity' => 1,
                'unit' => 1,
                'price' => $file[3],
                
                
            ]
        ]];
        //update internet-services for customer
        $result = $api->api_call_post("admin/finance/invoices", $data_array);
        if ($result) {
            file_put_contents($log_file, "Customer's {$file[0]} invoice created number:{$file[2]}\n", FILE_APPEND);
      
        } else {
            file_put_contents($log_file, "ERROR! Customer's {$file[0]} invoice NOT created number:{$file[2]}, {$api->response_code}\n", FILE_APPEND);
          
      

    }
}

?>