<?php

   include "../includes/db_con.php";
   include "../includes/date_today.php";

   $ref_no =  $_POST['ref_no'];

   // not_attended($conn, $ref_no);

   $sel_approved_appl_query = "SELECT * FROM `adoption_transaction` a
   JOIN `adoption_status` b
   ON a.adoption_id = b.adoption_id 
   JOIN `pet_details` c
   ON a.pet_id = c.pet_id
   JOIN `adoption_schedule` d
   ON a.`adoption_id` = d.`adoption_id`
   JOIN `ci` e
   ON a.reference_no = e.reference_no
   WHERE b.`status` != 'approved' AND a.`reference_no` = '$ref_no'; ";

   $res_approved_appl = mysqli_query($conn, $sel_approved_appl_query);

   // Check if query returned any rows
   if (mysqli_num_rows($res_approved_appl) > 0) {
       $applicant = mysqli_fetch_assoc($res_approved_appl);
   } else {
       $applicant = null;  // Ensure $applicant is null if no result found
   }

   // Initialize $date_schedule with a fallback value
   $date_schedule = '';

   if ($applicant) {
       // Check if keys exist before accessing
       $date_of_application = isset($applicant['date_of_schedule']) ? $applicant['date_of_schedule'] : '';
       $time_of_application = isset($applicant['time']) ? $applicant['time'] : '';
       $date_of_interview = "$date_of_application $time_of_application";
       $date_of_interview = new DateTime("$date_of_interview");
       $date_of_interview = $date_of_interview->format('M d, Y');

       // Set $date_schedule if it exists in the $applicant array
       $date_schedule = isset($applicant['datetime']) ? $applicant['datetime'] : '';

       if ($date_schedule) {
           $date_schedule = new DateTime("$date_schedule");
           $date_schedule = $date_schedule->format('M d, Y h:i A');
       }

       $date_process = isset($applicant['date_update']) ? $applicant['date_update'] : '';
       $date_process = new DateTime($date_process);
       $date_process = $date_process->format("Y-m-d");

   } else {
       // Handle case where no applicant data is found
       echo "<p>No application found for reference number $ref_no</p>";
   }

   // HOUSES
   $sel_appl_house_query = "SELECT a.`reference_no`, c.images FROM `adoption_transaction` a
   JOIN `adoption_status` b
   ON a.adoption_id = b.adoption_id
   JOIN `adoption_house` c
   ON a.adoption_id = c.adoption_id
   WHERE b.`status` = 'approved' AND a.`reference_no` = '$ref_no';";

   $res_appl_house = mysqli_query($conn, $sel_appl_house_query);

?>

<!-- View approved application -->
<div class="view-appl-container">

<div class="ref-no-date">
   <p> reference number: <b> <?=$applicant ? $applicant['reference_no'] : 'N/A' ?> </b> </p>
   <p> date of application: <b> <?=$date_schedule ?> </b> </p>
</div>

<div class="adopter-details">
   <h3> adopter's details </h3>

   <div class="adopter-detail-section">
      <div class="details">
         <div class="form-input-disable">
            <p> name: </p>
            <input type="text" value="<?=$applicant ? $applicant['fullname'] : '' ?>" readonly>
         </div>

         <div class="form-input-disable">
            <p> email: </p>
            <input type="text" style="text-transform:lowercase" value="<?=$applicant ? $applicant['email'] : '' ?>" readonly>
         </div>

         <div class="form-input-disable">
            <p> contact: </p>
            <input type="text" value="<?=$applicant ? $applicant['contact'] : '' ?>" readonly>
         </div>

         <div class="form-input-disable">
            <p> address: </p>
            <input type="text" value="<?=$applicant ? $applicant['address'] : '' ?>" readonly>
         </div>
      </div>
      
      <div class="id-1x1">
         <div class="image">
            <img src="../<?=$applicant ? $applicant['1by1_id'] : '' ?>" alt="">
         </div>
      </div>
   </div>   
</div>

<div class="pet-details">
   <h3> pet's details </h3>

   <div class="pet-detail-section">
      <div class="details">
         <div class="form-input-disable">
            <p> name: </p>
            <input type="text" value="<?=$applicant ? $applicant['pet_name'] : '' ?>" readonly>
         </div>

         <div class="form-input-disable">
            <p> species/type: </p>
            <input type="text" value="<?=$applicant ? $applicant['pet_species'] : '' ?>" readonly>
         </div>

         <div class="form-input-disable">
            <p> breed: </p>
            <input type="text" value="<?=$applicant ? $applicant['pet_breed'] : '' ?>" readonly>
         </div>

         <div class="form-input-disable">
            <p> sex: </p>
            <input type="text" value="<?=$applicant ? $applicant['pet_gender'] : '' ?>" readonly>
         </div>
      </div>
      
      <div class="pet-image">
         <div class="image">
            <img src="../pets_image/<?=$applicant ? $applicant['pet_image'] : '' ?>" alt="">
         </div>
      </div>
   </div>   
</div>

<div class="button-sched">
   <div class="date-of-interview">
     <p> status: <?php if($applicant && $applicant['status'] === 'not attended') {?>
      
      <span style="color: grey;"> <?=$applicant['status']?> </span>
      
      <?php } else { ?> 

         <span style="color: red;"> <?=$applicant ? $applicant['status'] : '' ?> </span>
      
      <?php }?> </p>
            
      <p> date of application: <b> <?=$date_schedule ?> </b> </p>
   </div>

   <div class="form-button-back">
      <button id="view-appl_back"> 
         <!-- <i class="fa fa-arrow-left" aria-hidden="true"></i> -->
         close 
      </button>
   </div>
</div>

</div>

<script>
   $("#view-appl_back").click(function(){
      $("#modal-appl-view").hide();
   });
</script>
