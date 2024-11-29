<?php 
   session_start();
   include "../../../includes/db_con.php";
   include "../../../function/owner_function.php";

   $ownerid = $_SESSION['owner-id'];

   $owner_logged = selowner($conn, $ownerid);

   $oldPass = $_POST['oldPass'];

   if(isset($oldPass)){

      if(strlen($oldPass) > 8) {

         if($oldPass == $owner_logged['password']) {

            echo "<span style='color: green;'> Password match </span>";

         } else {
            echo "<span style='color: red;'> Password didn't match </span>";
         }

      }

   }


  

?>