<?php
   $owner_id = $_POST['owner_id'];
   $owner_name = $_POST['owner_name'];


?>

<div class="message-box">
   
   <div class="icon-ask">
      <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
   </div>

   <div class="ask-decline">
      <p> Are you sure you want deactivate this owner? </p>
      <h1> <?=$owner_name?> </h1>
   </div>

   <div class="form-button">
      
      <button class="owner-no-btn"> No </button>
      <button class="owner-yes-btn" data-owner_id=<?=$owner_id?>> Yes </button>
   </div>

</div>


<script>
   $(document).ready(function(){
      
      $('.owner-no-btn').click(function(){
      
         $('.owner-message').hide();
      
      });

      $('.owner-yes-btn').click(function(){

         var ownerid = $(this).data('owner_id');
         var owner_y = $('.owner-yes-btn').serialize();

         $("#view-owner-modal").hide();

         $("#owner-item-display").load('./php/pagination_owner.php', {

            ownerid:ownerid,
            owner_y:owner_y, 

         });

         // alert(ownerid);

      });


   });
</script>