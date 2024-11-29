<?php
   session_start();
   include "../includes/db_con.php";
   include "../includes/date_today.php";
   include "../function/owner_function.php";

   $owner_id = $_SESSION['owner-id'];

   if(isset($_POST['change_pass_btn'])){

      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $contact = $_POST['contact'];
      $address = $_POST['address'];
      
      $old_pass = $_POST['old_pass'];
      $new_pass = $_POST['new_pass'];
      $confirm_pass = $_POST['confirm_pass'];

      // echo "$firstname $lastname $contact $address $old_pass $new_pass $confirm_pass <br>";

      include "../includes/select_all.php";

      if($old_pass === $owner_logged['temp_pass']) {


         if($new_pass === $old_pass) {

            header("location: ../owner_verification.php?err=new pass and old pass can't be equal");

         } else {
            
            if($new_pass === $confirm_pass) {

               $owner_avatar = $_FILES['owner_avatar'];

               $owner_img_name = $_FILES['owner_avatar']['name'];
               $owner_img_size = $_FILES['owner_avatar']['size'];
               $owner_img_tmp_name = $_FILES['owner_avatar']['tmp_name'];
               $owner_img_tmp_error = $_FILES['owner_avatar']['error'];
         
               if($owner_img_tmp_error === 0) {
         
                  $owner_img_ext = pathinfo($owner_img_name, PATHINFO_EXTENSION);
         
                  $owner_img_ext_lc = strtolower($owner_img_ext);
         
                  $allowed_ext = array("jpg","jpeg","png");
         
                  if(in_array($owner_img_ext_lc, $allowed_ext)) {
         
                     $new_owner_img_name = uniqid("owner_img-").'.'.$owner_img_ext_lc;
          
                     $img_owner_path = "../owner_profile/".$new_owner_img_name;
         
                     move_uploaded_file($owner_img_tmp_name, $img_owner_path);
         
                     update_owner($conn, $owner_id, $firstname, $lastname, $contact, $address, $new_owner_img_name, $new_pass);

                     header("location: ../index.php");
         
                  }
         
         
               }
               
   
            } else {

               header("location: ../owner_verification.php?err=new pass and confirm pass didn't match");
               // echo "new pass and confirm pass didn't match";

            }

         }

         
      } else {

         header("location: ../owner_verification.php?err=old password incorrect");
         // echo "old password incorrec";  
      }
     

   }
?>