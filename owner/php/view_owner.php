<?php
   include "../includes/db_con.php";
   
   $owner_id = $_POST['owner_id'];
   
   include "../includes/select_all.php";
  

?>

<div class="owner-profile-container">
   <div class="owner-profile">
      <div class="owner-avatar">
         <?php 
               if(empty($owner_logged['avatar'])) { ?>

                  <p> <?=$owner_logged['initial_email']?> </p>

               <?php } else { ?>

                  <img src="./owner_profile/<?=$owner_logged['avatar']?>" alt="">

               <?php } ?>
      </div>
      <h3> <?=$owner_logged['user_type']?> </h3>
      <h4>  <?=$owner_logged['email']?> </h4>
      <h5> Date Created: <?=$owner_logged['date_created']?> </h5>
   </div>

   <div class="owner-info">
      <div class="text-info">
         <h3> owner ID </h3>
         <p class="owner-id"> <?=$owner_logged['owner_id']?> </p>
      </div>

      <div class="text-info text-name">
         <div class="first-name">
            <h3>  FIRSTNAME </h3>
            <p>  
               <?php if(empty($owner_logged['firstname'])){
                  echo "<span style='color:#b44444; font-weight: 500'> not verified yet </span>";
               }else{ 
                  echo $owner_logged['firstname'];
               } ?>
             </p>
         </div>

         <div class="last-name">
            <h3> LASTNAME </h3>
            <p>
               <?php if(empty($owner_logged['lastname'])){
                  echo "<span style='color:#b44444; font-weight: 500'> not verified yet </span>";
               }else{ 
                  echo $owner_logged['lastname'];
               } ?>
            </p>
         </div>
      </div>

      <div class="text-info">
         <h3> CONTACT NUMBER </h3>
         <p>
            <?php if(empty($owner_logged['contact'])){
               echo "<span style='color:#b44444; font-weight: 500'> not verified yet </span>";
            }else{ 
               echo $owner_logged['contact'];
            } ?>
         </p>
      </div>

      <div class="text-info">
         <h3> ADDRESS </h3>
         <p>
            <?php if(empty($owner_logged['address'])){
               echo "<span style='color:#b44444; font-weight: 500'> not verified yet </span>";
            }else{ 
               echo $owner_logged['address'];
            } ?>
         </p>
      </div>


   </div>

   <div class="form-button">
      <button type="button" class="deactivate-owner" data-role="deact-owner" data-owner_id="<?=$owner_logged['owner_id']?>"> Deactivate </button>

      <button type="button" class="close-owner-modal"> Close </button>
   </div>
</div>



<div class="owner-message">

</div>

<script>

   $(document).ready(function(){

      $('.owner-message').hide();

      $('.close-owner-modal').click(function(){

         $("#view-owner-modal").hide();

      });


      $('button[data-role=deact-owner]').click(function(){

         var owner_id = $(this).data("owner_id");
         var owner_name = "<?=$owner_logged['firstname']?> <?=$owner_logged['lastname']?>";

         $('.owner-message').show();

         $('.owner-message').load('./modal/owner_message.php',{

            owner_id: owner_id, 
            owner_name, owner_name

         });
         

      });

   });

</script>