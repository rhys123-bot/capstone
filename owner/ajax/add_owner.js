$(document).ready(function(){

   $("#btn_add_owner").click(function(){

      var btn_owner = $("#btn_add_owner").val();
      var email = $("#e-mail").val();
      var owner_type = $("#owner-type").val();

      

      if(email != '' && owner_type != ''){

         $("#owner-item-display").load('./php/insert_owner.php',{
            
            btn_owner:btn_owner,
            email:email,
            owner_type:owner_type,
   
         });

      } else {

         alert('fill up first');

      }


      // if (email === '' && owner_type === ''){

      //    alert('fill up first');

      // } else {
         
      //    $("#owner-item-display").load('./php/insert_owner.php',{
   
      //       btn_owner:btn_owner,
      //       email:email,
      //       owner_type:owner_type,
   
      //    });
         
      // }

      

   });


   load_data()
   function load_data(page){
      $.ajax({
         url: "./php/pagination_owner.php",
         method: "POST",
         data: {page:page},
         success: function(data){
            $("#owner-item-display").html(data);
         }
      })
   }

   $(document).on('click', '.pagination_link', function(){
      var page = $(this).attr("id");
      load_data(page);
   });

});