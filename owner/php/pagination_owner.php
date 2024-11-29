<?php

 

   session_start();

   include "../includes/db_con.php";
   include "../function/function.php";
   include "../includes/date_today.php";
   
   $owner_id = $_SESSION['owner-id'];
   


   if(isset($_POST['owner_y'])){

      // echo "hello world";

      include "../function/owner_function.php";

      $ownerid = $_POST['ownerid'];

      // echo $ownerid;

      $success = deactivate_owner($conn, $ownerid);

      if(!$success){

         echo mysqli_error($conn);
      
      } else {

         $userType = $_SESSION['user_type'];
         $activity = "Deactivate owner";

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

   $sel_owner_query = "SELECT *, c.status as `owner_verify`, LEFT(a.email, 1) as initial_email FROM `owner_info` a 
   JOIN `user_account` b
   ON a.owner_id = b.account_id
   JOIN `owner_temporary_account` c 
   ON a.owner_id = c.owner_id
   JOIN `owner_status` d
   ON a.owner_id = d.owner_id
   WHERE b.user_type = 'owner' AND d.status = 'active'";

if(isset($_POST["search"])){
    $search= $_POST["search"];
    $sel_owner_query .= "AND a.email LIKE '%$search%'";
    
}
$sel_owner_query .= "ORDER BY a.id DESC LIMIT $start_from,  $record_per_page";
   $res_owner_res = mysqli_query($conn, $sel_owner_query);

   $output .= '<table border="0" width="100%">
                  <thead>
                     <tr>
                        <th style="text-align:center;"> id </th>
                        <th style="text-align:center;"> owner id </th>
                        <th style="text-align:center;"> avatar </th>
                        <th> email </th>
                        <th style="text-align:center;"> status </th>
                        <th style="text-align:center;"> position</th>
                        <th> date created </th>
                        <th> action </th>
                     </tr>
                  </thead>
               <tbody>';
      
         // include "../includes/select_all.php";

         if (mysqli_num_rows($res_owner_res) > 0) { 

            while($owner_row = mysqli_fetch_assoc($res_owner_res)) { 

               $date_created = $owner_row['date_created'];
               $date_created = new DateTime("$date_created");
               $date_created = $date_created->format('M d, Y');
            
               // $output
               $output .= ' <tr>
                              <td style="text-align:center;">'. $owner_row['id'] .'</td>
                              <td style="text-align:center;">'. $owner_row['account_id'] .'</td>
                              <td class="avatar">';

                              if(!empty($owner_row['avatar'])) {
                                 $output .= '<div class="owner-avatar">
                                                <img src="./owner_profile/'.$owner_row['avatar'].'" alt="">
                                             </div>';
                                
                              } else { 

                                 $output .= '<div class="owner-avatar">
                                                <p>'. $owner_row['initial_email'] .'</p>
                                             </div>
                              </td>';      
                              }
                              
                              $output .= '<td>'. $owner_row['email'] .'</td>
                              <td style="text-align:center; text-transform:capitalize">'. $owner_row['owner_verify'] .'</td>
                              <td style="text-align:center; text-transform:capitalize""> Staff </td>
                              <td>'.$date_created.'</td>
                              <td class="owner-action"> 
                                 <button class="view-owner-btn" data-role="view_owner" data-owner_id="'.$owner_row['account_id'].'"> <i class="fas fa-eye"></i> View </button>
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
         WHERE b.account_id != '$owner_id' AND d.status = 'active' ORDER BY a.id";
         
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
      
      $('button[data-role=view_owner]').click(function(){

         $("#view-owner-modal").show();

         var owner_id = $(this).data("owner_id");
         
         $('#view-owner-modal').load('./php/view_owner.php',{

            owner_id:owner_id
            
         });
      
      });
   });

</script>
