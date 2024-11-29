<?php


function owner_id($conn){
   $id_count = 11; 
   
   $generated_ids = array();
   
   for ($i = 1; $i < $id_count; $i++) {
      
      while (true) {
         
         $id = uniqid('owner_', false);
   
         $sql = "SELECT * FROM `owner_temporary_account` WHERE `owner_id` = '$id'";
   
         $result = $conn->query($sql);
   
         if (mysqli_num_rows($result) == 0) {
   
            array_push($generated_ids, $id);

            break;
   
         }
      }
   }

   return $id;
}


function deactivate_owner($conn, $owner_id){

   $upd_owner_status_query = "UPDATE `owner_status` SET `status`='inactive' WHERE `owner_id`='$owner_id'";

   $res_owner_status = mysqli_query($conn, $upd_owner_status_query);

   return $res_owner_status;

}


function activate_owner($conn, $owner_id){

   $upd_owner_status_query = "UPDATE `owner_status` SET `status`='active' WHERE `owner_id`='$owner_id'";

   $res_owner_status = mysqli_query($conn, $upd_owner_status_query);

   return $res_owner_status;

}


function selowner($conn, $ownerID){

   $sel = "SELECT *, c.status as `owner_verifiy`, LEFT(a.firstname, 1) as `initial_fname`, LEFT(a.email, 1) as `initial_email` FROM `owner_info` a 
   JOIN `user_account` b
   ON a.owner_id = b.account_id
   JOIN `owner_temporary_account` c
   ON a.owner_id = c.owner_id 
   JOIN `owner_status` d
   ON a.owner_id = d.owner_id
   WHERE b.account_id = '$ownerID' AND d.status = 'active';";

   $res = mysqli_query($conn, $sel);

   $owner = mysqli_fetch_assoc($res);

   return $owner;

}



function insert_owner($conn, $owner_id, $email, $temp_pass, $curr_date, $owner_type) {

   // owner: TEMP ACC TABLE
   $ins_owner_query = "INSERT INTO `owner_temporary_account`
   (`owner_id`, `email`, `temp_pass`, `status`) 
   VALUES 
   ('$owner_id','$email','$temp_pass','not verified')";

   // owner: USER_ACCOUNT
   $ins_user_acc_query = "INSERT INTO `user_account`
   (`account_id`, `email`, `user_type`) 
   VALUES 
   ('$owner_id','$email','$owner_type')";

   // owner: owner INFO
   $ins_owner_info_query = "INSERT INTO `owner_info`
   (`owner_id`, `email`, `date_created`) 
   VALUES 
   ('$owner_id','$email','$curr_date')";


   // owner: owner STATUS
   $ins_owner_status_query = "INSERT INTO `owner_status` (`owner_id`, `status`, `datetime`)
   VALUES
   ('$owner_id', 'active', '$curr_date')";



   $ifSuccess = false;

   $res_owner = mysqli_query($conn, $ins_owner_query);
   $res_user_acc = mysqli_query($conn, $ins_user_acc_query);
   $res_owner_info = mysqli_query($conn, $ins_owner_info_query);
   $res_status = mysqli_query($conn, $ins_owner_status_query);

   if($res_owner && $res_user_acc && $res_owner_info && $res_status){

      $ifSuccess = true;
      send_temp_acc($conn, $owner_id);


   } else {

      $ifSuccess = false;
      echo mysqli_error($conn);
   
   }

   return $ifSuccess;

}

function updProfile($conn, $ownerID, $image){
   $upd = "UPDATE `owner_info` SET `avatar`= '$image'
   WHERE `owner_id` = '$ownerID' ";

   $res = mysqli_query($conn, $upd);

   return $res;
}

function changePass($conn, $ownerID, $newPass){

   $upd = "UPDATE `user_account` SET 
   `password`='$newPass'
   WHERE `account_id` = '$ownerID'";

   $res = mysqli_query($conn, $upd);

   return $res;

}


function ownActLog($conn, $ownerID){

   $sel_act = "SELECT *, a.id as `act_id` FROM `activity_log` a
   JOIN `owner_info` b
   ON a.users_id = b.owner_id
   WHERE a.users_id = '$ownerID' ORDER BY a.`id` DESC;";

   $sel = "WITH difference_in_seconds as (
      SELECT *, TIMESTAMPDIFF(SECOND, `date`,  CURDATE()) as `seconds` FROM `activity_log`
   ),
  
   differences AS (
         SELECT
         *,
         MOD(seconds, 60) AS seconds_part,
         MOD(seconds, 3600) AS minutes_part,
         MOD(seconds, 3600 * 24) AS hours_part
         FROM difference_in_seconds
   )
  
   SELECT
      *,
      CONCAT(
         FLOOR(seconds / 3600 / 24), ' days ',
         FLOOR(hours_part / 3600), ' hours ',
         FLOOR(minutes_part / 60), ' minutes ',
         seconds_part, ' seconds'
      ) AS difference
   FROM differences a
   JOIN `owner_info` b
   ON a.users_id = b.owner_id
   WHERE a.users_id = '$ownerID' ORDER BY a.`id` DESC;";

   $res = mysqli_query($conn, $sel_act);

   return $res;

}


function updownerInfo($conn, $ownerID, $fname, $lname, $cnum, $address){

   $upd = "UPDATE `owner_info` SET 
   `firstname`= '$fname', 
   `lastname`= '$lname',
   `contact` ='$cnum', 
   `address`= '$address'
   WHERE `owner_id` = '$ownerID' ";

   $res = mysqli_query($conn, $upd);

   return $res;


}


function update_owner($conn, $owner_id, $firstname, $lastname, $contact, $address, $new_owner_img_name, $new_pass) {
      
   // owner INFO
   $upd_owner_info_query = "UPDATE `owner_info` SET 
   `firstname`= '$firstname', 
   `lastname`= '$lastname',
   `contact` ='$contact', 
   `address`= '$address', 
   `avatar`= '$new_owner_img_name' 
   WHERE `owner_id` = '$owner_id' ";


   // owner TEMP_ACCOUNT
   $upd_owner_temp_acc_query = "UPDATE `owner_temporary_account` SET 
   `temp_pass`= '$new_pass', 
   `status` = 'verified'
   WHERE `owner_id` = '$owner_id'";
   

   // owner ACCOUNT ON user_account table
   $upd_owner_acc_query = "UPDATE `user_account` SET `password`='$new_pass' WHERE `account_id` = '$owner_id' ";


   $owner_info_upd = mysqli_query($conn, $upd_owner_info_query);
   $owner_temp_acc_upd = mysqli_query($conn, $upd_owner_temp_acc_query);
   $owner_acc_upd = mysqli_query($conn, $upd_owner_acc_query);


   if(!$owner_info_upd && !$owner_temp_acc_upd && !$owner_acc_upd){

      echo mysqli_error($conn);

   }

}



?>