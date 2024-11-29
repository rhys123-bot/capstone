<?php

   include "../includes/db_con.php";
   include "../includes/date_today.php";
   include "../function/function.php";
   include "../function/owner_function.php";

   $ownerID = $_POST['owner_id'];
   $owner_role = $_POST['owner_role'];
   $owner_fname = $_POST['owner_fname'];
   $owner_lname = $_POST['owner_lname'];
   $owner_cnum = $_POST['owner_cnum'];
   $owner_add = $_POST['owner_add'];

   try {

      $updowner = updownerInfo($conn, $ownerID, $owner_fname, $owner_lname, $owner_cnum, $owner_add);

      if($updowner){

         $activity = "Update personal information";
         activityLog($conn, $ownerID, $owner_role, $activity, $date_today);

         echo '<p style="color: #fff; padding: 5px 10px; border-radius: 3px; background-color: rgb(107, 220, 131); margin-right: 10px; "> Update Successfuly </p>';

         ?>

         <script>
            window.location.href = "./profile.php";
         </script>
         
         <?php 

         

      } else {

         echo '<p style="color: #fff; padding: 5px 10px; border-radius: 3px; background-color: rgb(220, 107, 107); margin-right: 10px; "> Query Error! </p>';
      }

   } catch (\Throwable $th) {

      echo '<p style="color: #fff; padding: 5px 10px; border-radius: 3px; background-color: rgb(220, 107, 107); margin-right: 10px; "> Query Error! </p>';

   }

?>