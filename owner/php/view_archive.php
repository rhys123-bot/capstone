<?php
   include "../includes/db_con.php";
   
   $owner_id = $_POST['owner_id'];
   
   $sel_inactive_owner_query = "SELECT *, LEFT(a.email, 1) as `initial_email` FROM `owner_info` a 
   JOIN `user_account` b
   ON a.owner_id = b.account_id
   JOIN `owner_temporary_account` c 
   ON a.owner_id = c.owner_id
   JOIN `owner_status` d
   ON a.owner_id = d.owner_id
   WHERE d.status = 'inactive' AND a.owner_id = '$owner_id'";

   $res_archive_owner = mysqli_query($conn, $sel_inactive_owner_query);

   $archive_owner = mysqli_fetch_assoc($res_archive_owner);
  

?>

<div class="owner-profile-container">
   <div class="owner-profile">
      <div class="owner-avatar">
         <?php 
               if(empty($archive_owner['avatar'])) { ?>

                  <p> <?=$archive_owner['initial_email']?> </p>

               <?php } else { ?>

                  <img src="./owner_profile/<?=$archive_owner['avatar']?>" alt="">

               <?php } ?>
      </div>
      <h3> <?=$archive_owner['user_type']?> </h3>
      <h4>  <?=$archive_owner['email']?> </h4>
      <h5> Date Created: <?=$archive_owner['date_created']?> </h5>
   </div>

   <div class="owner-info">
      <div class="text-info">
         <h3> owner ID </h3>
         <p class="owner-id"> <?=$archive_owner['owner_id']?> </p>
      </div>

      <div class="text-info text-name">
         <div class="first-name">
            <h3>  FIRSTNAME </h3>
            <p>  
               <?php if(empty($archive_owner['firstname'])){
                  echo "<span style='color:#b44444; font-weight: 500'> not verified yet </span>";
               }else{ 
                  echo $archive_owner['firstname'];
               } ?>
             </p>
         </div>

         <div class="last-name">
            <h3> LASTNAME </h3>
            <p>
               <?php if(empty($archive_owner['lastname'])){
                  echo "<span style='color:#b44444; font-weight: 500'> not verified yet </span>";
               }else{ 
                  echo $archive_owner['lastname'];
               } ?>
            </p>
         </div>
      </div>

      <div class="text-info">
         <h3> CONTACT NUMBER </h3>
         <p>
            <?php if(empty($archive_owner['contact'])){
               echo "<span style='color:#b44444; font-weight: 500'> not verified yet </span>";
            }else{ 
               echo $archive_owner['contact'];
            } ?>
         </p>
      </div>

      <div class="text-info">
         <h3> ADDRESS </h3>
         <p>
            <?php if(empty($archive_owner['address'])){
               echo "<span style='color:#b44444; font-weight: 500'> not verified yet </span>";
            }else{ 
               echo $archive_owner['address'];
            } ?>
         </p>
      </div>


   </div>

   <div class="form-button">
      <button type="button" class="activate-owner" data-role="activate-owner" data-owner_id="<?=$archive_owner['owner_id']?>"> Activate </button>

      <button type="button" class="close-archive-modal"> Close </button>
   </div>
</div>



<div class="archive-message">

</div>

<script>

   $(document).ready(function(){

      $('.archive-message').hide();

      $('.close-archive-modal').click(function(){

         $("#view-archive-modal").hide();

      });


      $('button[data-role=activate-owner]').click(function(){

         var owner_id = $(this).data("owner_id");
         var owner_name = "<?=$archive_owner['firstname']?> <?=$archive_owner['lastname']?>";

         // alert(owner_name);

         $('.archive-message').show();

         $('.archive-message').load('./modal/archive_message.php',{

            owner_id: owner_id, 
            owner_name, owner_name

         });
         

      });

   });

</script>