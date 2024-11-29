<?php
   $owner_id = $_POST['owner_id'];
   $owner_name = $_POST['owner_name'];


?>

<div class="message-box">
   
   <div class="icon-ask">
      <i class="fa fa-question-circle" aria-hidden="true"></i>
   </div>

   <div class="ask-decline">
      <p> Are you sure you want activate this owner? </p>
      <h1> <?=$owner_id?> </h1>
   </div>

   <div class="form-button">
      
      <button class="owner-no-btn"> No </button>
      <button class="owner-yes-btn" data-owner_id=<?=$owner_id?>> Yes </button>
   </div>

</div>


<script>
   $(document).ready(function(){
      
      $('.owner-no-btn').click(function(){
      
         $('.archive-message').hide();
      
      });

      $('.owner-yes-btn').click(function(){

         var ownerid = $(this).data('owner_id');
         var owner_y = $('.owner-yes-btn').serialize();

         $("#view-archive-modal").hide();

         $("#archive-item-container").load('./php/pagination_archive.php', {

            ownerid:ownerid,
            activate_owner_y:owner_y, 

         });

         // alert(ownerid);

      });


   });
</script>