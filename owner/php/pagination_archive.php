<?php

 

   session_start();

   include "../includes/db_con.php";
   include "../function/function.php";
   include "../includes/date_today.php";

   $owner_id = $_SESSION['owner-id'];
   

   if(isset($_POST['activate_owner_y'])){

      // echo "hello world";

      include "../function/owner_function.php";

      $ownerid = $_POST['ownerid'];

      // echo $ownerid;

      $success = activate_owner($conn, $ownerid);

      if(!$success){

         echo mysqli_error($conn);
      
      } else {

         $userType = $_SESSION['user_type'];
         $activity = "Re-activate owner";

         activityLog($conn, $owner_id, $userType, $activity, $date_today);
      }
   }

 
   

   $record_per_page = 10;

   $page = "";

   $output = "";
   
   if(isset($_POST['page'])){

      $page = $_POST['page'];
   
   } else {

      $page = 1;

   }

   $start_from = ($page - 1 ) * $record_per_page;

//   $sel_owner_query = "SELECT *, c.status as `owner_verify`, LEFT(a.email, 1) as initial_email FROM `owner_info` a 
//   JOIN `user_account` b
//   ON a.owner_id = b.account_id
//   JOIN `owner_temporary_account` c 
//   ON a.owner_id = c.owner_id
//   JOIN `owner_status` d
//   ON a.owner_id = d.owner_id
//   WHERE b.account_id != '$owner_id' AND b.account_id != 'superowner001' AND d.status = 'active' ORDER BY a.id DESC LIMIT $start_from,  $record_per_page";

//   $res_owner_res = mysqli_query($conn, $sel_owner_query);

   $output .= '<table border="0" width="100%">
                  <thead>
                     <tr>
                        <th style="text-align:center;"> archive id </th>
                        <th style="text-align:center;"> owner id </th>
                        <th> email </th>
                        <th style="text-align:center;"> type </th>
                        <th> date & time </th>
                        <th> action </th>
                     </tr>
                  </thead>

                  <tbody>';
      
         // include "../includes/select_all.php";
         $sel_inactive_owner_query = "SELECT * FROM `owner_info` a 
         JOIN `user_account` b
         ON a.owner_id = b.account_id
         JOIN `owner_temporary_account` c 
         ON a.owner_id = c.owner_id
         JOIN `owner_status` d
         ON a.owner_id = d.owner_id
         WHERE b.account_id != '$owner_id' AND d.status = 'inactive' ORDER BY a.id DESC LIMIT $start_from,  $record_per_page;";

         $res_inactive_owner = mysqli_query($conn, $sel_inactive_owner_query);

         if(mysqli_num_rows($res_inactive_owner) > 0) {
            while($inactive_owner = mysqli_fetch_assoc($res_inactive_owner)){ 
            
               // $output
               $output .= '<tr>
                              <td style="text-align:center;">'. $inactive_owner['id'] .'</td>
                              <td style="text-align:center;">'. $inactive_owner['owner_id'] .'</td>
                              <td>'. $inactive_owner['email'] .'</td>
                              <td class="archive-status">'. $inactive_owner['user_type'] .'</td>
                              <td>'. $inactive_owner['datetime'] .' </td>
                              <td class="archive-action">

                                 <div class="form-button">
                                    <button data-role="view_inactive-btn" data-owner_id="'.$inactive_owner['owner_id'].'"> View </button>
                                 </div>

                              </td>
                           </tr>';
               // output
            }
         }

         else { 

            $output .= '<tr>
                           <td colspan="8" style="text-align:center;"> No data fetch </td>
                        </tr>';
         }

      // page 
         $output .= '</tbody>
         </table> <div style="display: flex; align-items: center; margin-top: 10px; justify-content:center;">';
         
         $page_query = "SELECT * FROM `owner_info` a 
         JOIN `user_account` b
         ON a.owner_id = b.account_id
         JOIN `owner_temporary_account` c 
         ON a.owner_id = c.owner_id
         JOIN `owner_status` d
         ON a.owner_id = d.owner_id
         WHERE b.account_id != '$owner_id' AND d.status = 'inactive'";
         
         $page_res = mysqli_query($conn, $page_query);
      
         $total_records = mysqli_num_rows($page_res);
      
         $total_pages = ceil($total_records /  $record_per_page);
      
         
         for($i = 1; $i <= $total_pages; $i++) {
      
         $output .= "<span class='pagination_link' 
         style='cursor:pointer; padding: 6px; border: 1px solid #ccc; margin:3px;'
         id='".$i."'>". $i ."</span>";
         
         }
      // page

         $output .= "</div>";
         echo $output;
         // echo $total_pages;
?>
         
<script>
   
   $(document).ready(function(){
      
      $('button[data-role=view_inactive-btn]').click(function(){

         $("#view-archive-modal").show();

         var owner_id = $(this).data("owner_id");

         // alert(owner_id);
         
         $('#view-archive-modal').load('./php/view_archive.php',{

            owner_id:owner_id
            
         });
      
      });
   });

</script>
