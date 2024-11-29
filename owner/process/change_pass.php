<?php
   session_start();
   include "../includes/db_con.php";
   include "../includes/date_today.php";
   include "../function/owner_function.php";
   include "../function/function.php";

   $owner_id = $_SESSION['owner-id'];

   $owner = selowner($conn, $owner_id);

   $oldPass = $_POST['owner_oldPass'];
   $newPass = $_POST['owner_newPass'];
   $conPass = $_POST['owner_conPass'];

   if($oldPass == $owner['password']){

      if($newPass != $oldPass) {

         if($conPass == $newPass) {

            $isSuccess = changePass($conn, $owner_id, $newPass);

            if($isSuccess){

               $activity = "Change password";

               activityLog($conn, $owner_id, $owner['user_type'], $activity, $date_today);

               echo '<p style="color: #fff; padding: 5px 10px; border-radius: 3px; background-color: rgb(107, 220, 131); margin-right: 10px; "> Update Successfuly </p>';

               ?>
               <script>
                  window.location.href = "./security.php";
               </script>
               <?php 

            } else {

               echo '<p style="color: #fff; padding: 5px 10px; border-radius: 3px; background-color: rgb(220, 107, 107); margin-right: 10px; "> Query Error! </p>';

            }

         } else {

            echo "<p style='color: #fff; padding: 5px 10px; border-radius: 3px; background-color: rgb(220, 107, 107); margin-right: 10px;'> Confirm password should be the same with new password. </p>";

         }

      } else {
         
         echo "<p style='color: #fff; padding: 5px 10px; border-radius: 3px; background-color: rgb(220, 107, 107); margin-right: 10px;'>  New password should not be the same with old password. </p>";

      }

   } else {

       echo "<p style='color: #fff; padding: 5px 10px; border-radius: 3px; background-color: rgb(220, 107, 107); margin-right: 10px;'> Password didn't match </p>";

   }

?>