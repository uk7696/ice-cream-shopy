<?php
// Database configuration

$hostname="localhost";
$user_name = 'root';  
$user_password = '';  
$db_name= 'icecream_db';
// Create database connection  
$conn = new mysqli($hostname ,$user_name, $user_password ,$db_name);
 
// Check connection  
if (!$conn) {  
    echo"not connected"; 
}
function unique_id(){
    $chars='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength=strlen($chars);
    $randomString= '';
    for($i=0;$i<20;$i++){
        $randomString .= $chars[mt_rand(0,$charLength-1)];
    }
    return $randomString;
}

?>