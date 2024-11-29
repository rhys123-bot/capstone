<?php 

   session_start();
   include "../../../includes/db_con.php";
   include "../../../function/owner_function.php";

   $ownerid = $_SESSION['owner-id'];

   $owner_logged = selowner($conn, $ownerid);

   $oldPass = $_POST['oldPass'];
   $newPass = $_POST['newPass'];

   

   if(isset($newPass)){

      if(strlen($newPass) > 5){

         if(strlen($newPass) >= 8) {

            if($newPass == $oldPass || $newPass == $owner_logged['password']){
   
               echo "<span style='color: red;'> New password should not be the same with old password. </span>";
   
            } else {
   
               echo "<span style='color: green;'> Good </span>";
   
            }
   
         } else {
   
            echo "<span style='color: red;'> Password must be minimum of 8 characters  </span>";
   
         }

      }

   } else {
      echo "noo";
   }

?>