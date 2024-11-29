<?php
   // error_reporting(0);

   


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
   
   


   function updateAdoption($conn, $adopt_id, $status, $date){

      $upd_adopt_status_query = "UPDATE `adoption_status` SET `status`='$status', `date_update` = '$date' WHERE `adoption_id` = '$adopt_id'";

      mysqli_query($conn, $upd_adopt_status_query);

   }


?>