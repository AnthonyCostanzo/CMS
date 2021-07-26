<?php 

$db['db_host'] = 'localhost:8889';
$db['db_name'] = 'cms2';
$db['db_creds'] = 'root';

foreach($db as $key => $value) {
    define(strtoupper($key),$value);
}

$connection = mysqli_connect(DB_HOST,DB_CREDS,DB_CREDS,DB_NAME);
if($connection) {
    // echo 'connected';
} else {
    die('error');
}


?>