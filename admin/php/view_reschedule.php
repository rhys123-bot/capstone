<?php
include "../includes/db_con.php";
include "../includes/date_today.php";

$ref_no =  $_POST['ref_no'];

$sel_approved_appl_query = "SELECT * FROM `adoption_transaction` a
   JOIN `adoption_status` b
   ON a.adoption_id = b.adoption_id 
   JOIN `pet_details` c
   ON a.pet_id = c.pet_id
   JOIN `adoption_schedule` d
   ON a.`adoption_id` = d.`adoption_id` 
   JOIN `adoption_reschedule` e 
   ON a.reference_no = e.reference_no
   WHERE  a.`reference_no` = '$ref_no' AND e.remark_resched IS null; ";

$res_approved_appl = mysqli_query($conn, $sel_approved_appl_query);

if ($res_approved_appl && mysqli_num_rows($res_approved_appl) > 0) {
    // Fetch applicant data
    $applicant = mysqli_fetch_assoc($res_approved_appl);
    
    // Extract dates and times from the fetched applicant data
    $date_of_application = $applicant['date_of_schedule'];
    $time_of_application = $applicant['time'];
    $date_of_interview = "$date_of_application $time_of_application";
    $date_of_interview = new DateTime("$date_of_interview");
    $date_of_interview = $date_of_interview->format('M d, Y');

    $date_schedule = $applicant['datetime'];
    $date_schedule = new DateTime("$date_schedule");
    $date_schedule = $date_schedule->format('M d, Y h:i A');

    $date_process = $applicant['date_update'];
    $date_process = new DateTime($date_process);
    $date_process = $date_process->format("Y-m-d");
    
    // HOUSES Query
    $sel_appl_house_query = "SELECT a.`reference_no`, c.images 
                              FROM `adoption_transaction` a
                              JOIN `adoption_status` b
                              ON a.adoption_id = b.adoption_id
                              JOIN `adoption_house` c
                              ON a.adoption_id = c.adoption_id
                              WHERE b.`status` = 'approved' AND a.`reference_no` = '$ref_no';";

    $res_appl_house = mysqli_query($conn, $sel_appl_house_query);
} else {
    // If no results found, set applicant as empty array or handle appropriately
    $applicant = [];
}
?>

<!-- HTML Code (view approved application) -->

<div class="view-appl-container">
    <input type="hidden" id="ref-no" value="<?= isset($applicant['reference_no']) ? $applicant['reference_no'] : '' ?> ">
    <div class="ref-no-date">
        <p> reference number: <b> <?= isset($applicant['reference_no']) ? $applicant['reference_no'] : 'N/A' ?> </b> </p>
        <p> date of Interview: <b> <?= isset($date_schedule) ? $date_schedule : 'N/A' ?> </b> </p>
    </div>

    <div class="adopter-details">
        <h3> adopter's details </h3>
        <div class="adopter-detail-section">
            <div class="details">
                <div class="form-input-disable">
                    <p> name: </p>
                    <input type="text" value="<?= isset($applicant['fullname']) ? $applicant['fullname'] : 'N/A' ?>" readonly>
                </div>

                <div class="form-input-disable">
                    <p> email: </p>
                    <input type="text" style="text-transform:lowercase" value="<?= isset($applicant['email']) ? $applicant['email'] : 'N/A' ?>" readonly>
                </div>

                <div class="form-input-disable">
                    <p> contact: </p>
                    <input type="text" value="<?= isset($applicant['contact']) ? $applicant['contact'] : 'N/A' ?>" readonly>
                </div>

                <div class="form-input-disable">
                    <p> address: </p>
                    <input type="text" value="<?= isset($applicant['address']) ? $applicant['address'] : 'N/A' ?>" readonly>
                </div>
            </div>

            <div class="id-1x1">
                <div class="image">
                    <img src="../<?= isset($applicant['1by1_id']) ? $applicant['1by1_id'] : 'default.jpg' ?>" alt="">
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
                    <input type="text" value="<?= isset($applicant['pet_name']) ? $applicant['pet_name'] : 'N/A' ?>" readonly>
                </div>

                <div class="form-input-disable">
                    <p> species/type: </p>
                    <input type="text" value="<?= isset($applicant['pet_species']) ? $applicant['pet_species'] : 'N/A' ?>" readonly>
                </div>

                <div class="form-input-disable">
                    <p> breed: </p>
                    <input type="text" value="<?= isset($applicant['pet_breed']) ? $applicant['pet_breed'] : 'N/A' ?>" readonly>
                </div>

                <div class="form-input-disable">
                    <p> sex: </p>
                    <input type="text" value="<?= isset($applicant['pet_gender']) ? $applicant['pet_gender'] : 'N/A' ?>" readonly>
                </div>
            </div>

            <div class="pet-image">
                <div class="image">
                    <img src="../pets_image/<?= isset($applicant['pet_image']) ? $applicant['pet_image'] : 'default.jpg' ?>" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="home-visit">
        <h3> Re-Schedule Request </h3>
        <div class="adopter-detail-section">
            <div class="details">
                <div class="form-input-disable">
                    <p> Old Schedule </p>
                    <input type="text" value="<?= isset($applicant['old_schedule']) ? $applicant['old_schedule'] : 'N/A' ?>" readonly>
                </div>

                <div class="form-input-disable">
                    <p> New Schedule </p>
                    <input type="text" id="new-sched" value="<?= isset($applicant['new_schedule']) ? $applicant['new_schedule'] : 'N/A' ?>" readonly>
                </div>

                <div class="form-input-disable">
                    <p> Reason for Re-Schedule: </p>
                    <textarea name="" id="" rows="6" readonly><?= isset($applicant['reason']) ? $applicant['reason'] : 'N/A' ?></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="button-sched">
        <div class="form-button-back">
            <button id="view-appl_back">close</button>
        </div>
        <div class="form-button-back">
            <button class="resched-decline" id="decline-resched">Decline</button>
            <button class="resched-approve" id="approve-resched">Approve</button>
        </div>
    </div>

</div>

<script>
    $("#view-appl_back").click(function() {
        $("#modal-appl-view").hide();
    });

    $(document).ready(function() {
        $('#approve-resched').click(function(event) {
            event.preventDefault();
            var newsched = $('#new-sched').val();
            var remarks = "approve";
            var refno = $('#ref-no').val();
            $.ajax({
                url: './php/insert_reschedule.php',
                type: 'POST',
                data: {
                    newsched: newsched,
                    remarks: remarks,
                    refno: refno
                },
                success: function(response) {
                    $("#modal-appl-view").hide();
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });

        $('#decline-resched').click(function(event) {
            event.preventDefault();
            var remarks = "decline";
            var refno = $('#ref-no').val();
            $.ajax({
                url: './php/insert_reschedule.php',
                type: 'POST',
                data: {
                    remarks: remarks,
                    refno: refno
                },
                success: function(response) {
                    $("#modal-appl-view").hide();
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
