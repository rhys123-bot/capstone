$(document).ready(function(){

   
      $('#owner-old-pass').keyup(function(){

         let oldPass = $('#owner-old-pass').val();

         $('#old-pass-mess').load('./ajax/process/old_pass.php', {

            oldPass: oldPass,
         
         })

      });

      $('#owner-new-pass').keyup(function(){

         let oldPass = $('#owner-old-pass').val();
         let newPass = $('#owner-new-pass').val();

         $('#new-pass-mess').load('./ajax/process/new_pass.php', {

            oldPass: oldPass,
            newPass: newPass
         
         })

      });


      $('#owner-con-pass').keyup(function(){

         let conPass = $('#owner-con-pass').val();
         let newPass = $('#owner-new-pass').val();

         $('#con-pass-mess').load('./ajax/process/con_pass.php', {

            conPass: conPass,
            newPass: newPass
         
         });


      });



});