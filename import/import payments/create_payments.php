<?php
include 'SplynxApi.php';
$api_url = 'http://domain/'; // please set your Splynx URL
$admin_login = '';
$admin_password = '';
$api = new SplynxApi($api_url);
$api->setVersion(SplynxApi::API_VERSION_2);
$api->login([
    'auth_type' => SplynxApi::AUTH_TYPE_ADMIN,
    'login' => $admin_login,
    'secret' => $admin_password,
]);

$log_file = 'import_log.txt';

$urlCustom = "admin/finance/payments";


//file to array
$csv = array_map('str_getcsv', file('payments.csv')); //csv-file to array
//print_r($csv);

foreach ($csv as $file) {
    
        
    
        $data_array = [
            'payment_type' => 1,
            'customer_id' => $file[0],
            'receipt_number' => $file[4],
            'date' => $file[3],
            'amount' => $file[2],
            'comment' => $file[1]         
                
            
        ];
        //update internet-services for customer
        $result = $api->api_call_post("admin/finance/payments", $data_array);
        if ($result) {
            file_put_contents($log_file, "Customer's {$file[0]} payment created number:{$file[4]}\n", FILE_APPEND);
      
        } else {
            file_put_contents($log_file, "ERROR! Customer's {$file[0]} payment NOT created number:{$file[4]}, {$api->response_code}\n", FILE_APPEND);
          
      

    }
}

?>