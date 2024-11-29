<?php
   // error_reporting(1);
   include "../includes/db_con.php";
   include "../function/function.php";
  
   // include "./includes/select_all.php";

 


   if(isset($_POST['btn_owner'])) {      
      
      $email = $_POST['email'];

      $owner_type = $_POST['owner_type'];
   
      if(!empty($email) && !empty($owner_type)) {


         $check_email_exist = "SELECT * FROM `owner_temporary_account` WHERE `email` = '$email'";

         $res_email_exist = mysqli_query($conn, $check_email_exist);

         if(mysqli_num_rows($res_email_exist) > 0) {
            
            ?> 
            
               <script>

                     alert('this <?=$email?> is already exist');

               </script>
            
            <?php

            include "../php/pagination_owner.php";
         } 
         
         else { 
            
            // echo "owner registered...";
            include "../includes/date_today.php";
            include "../includes/random.php";
            include "../function/owner_function.php";
            include "../../function/sendemail.php";

            $owner_id = owner_id($conn);
            
            $temp_pass = generateRandomString();

            // echo "$owner_id $temp_pass";
            
            $insert_owner = insert_owner($conn, $owner_id, $email, $temp_pass, $date_today, $owner_type);

            // echo $insert_owner;

            if($insert_owner == 1) {

             
               $ownerid = $_SESSION['owner-id'];
               $userType = $_SESSION['user_type'];
               $activity = "Add owner";

               activityLog($conn, $ownerid, $userType, $activity, $date_today);
               
               ?> 
               
                  <script>

                     alert('<?=$email?> registered successfully. Wait for them to verify their account.');
                     
                     $('#add-owner-modal').hide(); 

                  </script>
         
               <?php

               include "../php/pagination_owner.php";

               
            }


           
               


         }

      } else {
         
         include "../php/pagination_owner.php";
         
      }
   }
               
                     
                     

?>
