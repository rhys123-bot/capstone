<?php

   session_start();
      
   // // SESSIONS
   $owner_id = $_SESSION['owner-id'];

   include "../includes/db_con.php";
   include "../includes/select_all.php";   

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title> My Account <?=$owner_logged['firstname']?> | PawsitiveMatch A Digital Pet Adoption Platform </title>
   
   <?php include "./header.php"; ?>
   
</head>
<body>

   <header>
      <div class="logo-title">
         <div class="logo">
            <div class="img-handler">
               <img src="../../assets/adopt-logo.png" alt="Naga City Animal Care and Adoption Center Logo">
            </div>
         </div>
         
         <div class="text-header">
            <p> PawsitiveMatch A Digital Pet Adoption Platform </p>
            <span>  A Digital Pet Adoption Platform | PawsitiveMatch  </span>
         </div>
      </div>

      <?php include "./nav-profile.php"; ?>

   </header>


   <main>

      <nav>
         <ul>
            <li> 
               <a href="./profile.php" class="selected"> <i class="fas fa-user-circle" aria-hidden="true"></i> Account </a>
            </li>
            <li> 
               <a href="./security.php" > <i class="fas fa-key"></i> Security </a>
            </li>
            <li> 
               <a href="./myActivity.php"> <i class="fas fa-list-alt "></i> My Activity </a>
            </li>
            <li> 
               <a href="../index.php"> <i class="fas fa-angle-left"></i> Back to dashboard </a>
            </li>
            
         </ul>
      </nav>


      <section>

         <div class="profile-container">

            <div class="header">
               <h2> Account </h2>
               <span id="message"></span>
            </div>

            <div class="owner-profile-container">

               <div class="owner-avatar">
                  <p> Avatar <span id="profile-mess"></span></p>

                  <div class="avatar">
                     <?php if($owner_logged['avatar'] == '') { 
                           ?>

                           <div class="img-handler">
                              <p> <?=$owner_logged['initial_fname']?> </p> 
                           </div>
                           <?php     

                     } else { 

                        ?>
                           <div class="img-handler">
                              <img src="../owner_profile/<?=$owner_logged['avatar']?>">
                           </div>
                        <?php

                     }?>
                    

                     <div class="form-upload">

                        <form id="update-profile">
                           <label for="owner-profile"> 
                              <i class="fas fa-camera-retro    "></i>
                           </label>

                           <input type="file" name="owner_profile" id="owner-profile" accept="image/jpeg, image/png, image/jpg" hidden>
                        </form>
                     </div>
                  </div>
               </div>


               <div class="owner-info">
                  <p> Profile information <span id="info-mess"></span></p>

                  <form id="update-owner-info">

                     <div class="form-inputs">

                        <div class="form-input">
                           <label for="owner-id"> owner ID </label>
                           <input type="text" name="owner_id" id="owner-id" value="<?=$owner_logged['owner_id']?>" readonly>
                        </div>

                        <div class="form-input">
                           <label for="owner-role"> Role </label>
                           <input type="text" name="owner_role" id="owner-role" value="<?=$owner_logged['user_type']?>" readonly>
                        </div>

                        <div class="form-input">
                           <label for="owner-fname"> Firstname </label>
                           <input type="text" name="owner_fname" id="owner-fname" value="<?=$owner_logged['firstname']?>" readonly>
                        </div>

                        <div class="form-input">
                           <label for="owner-lname"> Lastname </label>
                           <input type="text" name="owner_lname" id="owner-lname" value="<?=$owner_logged['lastname']?>" readonly>
                        </div>

                        <div class="form-input">
                           <label for="owner-email"> Email </label>
                           <input type="text" name="owner_email" id="owner-email" value="<?=$owner_logged['email']?>" readonly>
                        </div>

                        <div class="form-input">
                           <label for="owner-cnum"> Contact Number </label>
                           <input type="text" name="owner_cnum" id="owner-cnum" value="<?=$owner_logged['contact']?>" max="11" min="11" maxlength="11" minlength="11">
                        </div>
                     </div>

                     <div class="form-inputs address">
                        <div class="form-input ">
                           <label for="owner-add"> Address </label>
                           <input type="text" name="owner_add" id="owner-add" value="<?=$owner_logged['address']?>">
                        </div>
                     </div>

                     <div class="form-button">

                        <button type="submit"> Save </button>

                     </div>
                          
                  </form>
               </div>

            </div>

           
         </div>

      </section>

   </main>

</body>
<script>
   $(document).ready(function(){

      $('#owner-profile').change(function(){

         const form = $('#update-profile')[0];
         const formData = new FormData(form);

          $.ajax({

            url: "../process/change_profile.php",
            type: "POST",
            contentType: false, 
            processData: false,
            cache: false,
            data: formData,

            success: function(data){

               $('#message').html(data);
               
               // window.location.href = "./profile.php";

            }
                  

         });



      });


      $('#update-owner-info').submit(function(e){

         e.preventDefault(); // prevent reload when submit

         const form = $('#update-owner-info')[0];
         const formData = new FormData(form);

         $.ajax({

            url: "../process/change_info.php",
            type: "POST",
            contentType: false, 
            processData: false,
            cache: false,
            data: formData,

            success: function(data){

               $('#message').html(data);

               

            }
                  

         });



      });


   });
</script>

</html>
      
     