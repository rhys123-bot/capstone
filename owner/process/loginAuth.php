<?php

session_start();

include "../includes/db_con.php";
include "../function/function.php";
include "../includes/date_today.php";

function decrypt($value, $key) {
   $data = base64_decode($value);
   $iv = substr($data, 0, openssl_cipher_iv_length('aes-256-cbc'));
   $iv = str_pad($iv, 16, "\0");
   $encrypted = substr($data, openssl_cipher_iv_length('aes-256-cbc'));
   $result = openssl_decrypt($encrypted, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
   return $result;
}


$email = $_POST['email'];

$password = $_POST['password'];
$remember = $_POST['remember'];
$authenticated = "";

$slcQuery = "SELECT *, c.status as `owner_verify` FROM `user_account` a 
   JOIN `owner_temporary_account` b 
   ON a.account_id = b.owner_id 
   JOIN `owner_status` c
   ON a.account_id = c.owner_id
   WHERE (a.email = '$email' AND a.password = '$password' AND (`user_type` = 'owner' OR `user_type` = 'super owner')) OR (b.email = '$email' AND b.temp_pass = '$password');";


$result = mysqli_query($conn, $slcQuery);

$authenticated = false;

if (mysqli_num_rows($result) === 1) {

   $owner = mysqli_fetch_assoc($result);

   $owner_status = $owner['owner_verify'];

   if ($owner_status === 'active') {

      $_SESSION['owner-id'] = $owner['account_id'];

      $_SESSION['verify-status'] = $owner['status'];

      $_SESSION['user_type'] = $owner['user_type'];

      $verify_status = $owner['status'];

      $activity = "Login";

      activityLog($conn, $owner['account_id'], $owner['user_type'], $activity, $date_today);

      if ($remember == true) {
         setcookie('user_id', $owner["account_id"], time() + (30 * 24 * 60 * 60), '/');
      }
   
      if ($verify_status === "not verified") {

         $authenticated = "not verified";

      } else {

         $authenticated = "success";

      }

   } else {

      $authenticated = "not active";
   }

} 

if ($authenticated === "success") {
   echo "success";
} elseif ($authenticated === "not verified") {
   echo "not verified";
} elseif ($authenticated === "not active") {
   echo "not active";
} else {
   echo "failed";
}

?>