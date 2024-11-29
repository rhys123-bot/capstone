<?php 

   // USERS
   $cnt_users_query = "SELECT COUNT(*) AS `total-user` FROM `user_details`";

   $res_users = mysqli_query($conn, $cnt_users_query);

   $user_total = mysqli_fetch_assoc($res_users);
 

   // owner
   $cnt_owner_query = "SELECT COUNT(*) AS `total-owner` FROM `user_account` a
   JOIN `owner_status` b
   ON a.account_id = b.owner_id
   WHERE (`user_type` = 'owner') AND b.status = 'active'";

   $res_owners = mysqli_query($conn, $cnt_owner_query);

   $owner_total = mysqli_fetch_assoc($res_owners);


   // PETS
   $cnt_pet_query = "SELECT COUNT(DISTINCT b.pet_id) as `total-pet` FROM `pet_details` a
   JOIN `pet_status` b
   ON b.pet_id = a.pet_id
   JOIN `pet_story` c
   ON c.pet_id = a.pet_id;";


   $res_pets = mysqli_query($conn, $cnt_pet_query);

   $pet_total = mysqli_fetch_assoc($res_pets);

   // ADOPTED PETS
   $cnt_adopted_pets_query = "SELECT COUNT(DISTINCT b.pet_id) as `total-adopted` FROM `pet_status` a
   JOIN `pet_details` b
   ON a.pet_id = b.pet_id
   WHERE a.status = 'adopted';";

   $res_adopted_pets = mysqli_query($conn, $cnt_adopted_pets_query);

   $adopted_total = mysqli_fetch_assoc($res_adopted_pets);


   // CATS
   $cnt_cats_query = "SELECT COUNT(*) AS `total-cats` FROM `pet_details` WHERE `pet_species` = 'cat'";

   $res_cats = mysqli_query($conn, $cnt_cats_query);

   $cats_total = mysqli_fetch_assoc($res_cats);


   // DOGS
   $cnt_dogs_query = "SELECT COUNT(*) AS `total-dogs` FROM `pet_details` WHERE `pet_species` = 'dog'";

   $res_dogs = mysqli_query($conn, $cnt_dogs_query);

   $dogs_total = mysqli_fetch_assoc($res_dogs);





   // ABUSED REPORT
   $cnt_abuse_pet_query = "SELECT COUNT(*) AS `total-abuse` FROM `abuse_report`";

   $res_abuse_pet = mysqli_query($conn, $cnt_abuse_pet_query);

   $abuse_total = mysqli_fetch_assoc($res_abuse_pet);


?>