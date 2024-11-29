<?php
   include "../includes/db_con.php";
   include "./owner_function.php";
   include "../includes/random.php";
   include "../includes/date_today.php";  
   include "../../function/sendemail.php";

   include "./application_function.php";


   set_not_attended($conn, $curr_date, $curr_time);

   // $owner_id = owner_id($conn);
   // $temp_pass = generateRandomString();
   
   // sendEmail('mark.melvin.bacabis@gmail.com', 'mark', 'bacabis');

  
?>
