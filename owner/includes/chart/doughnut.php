<?php
    include "./includes/db_con.php";

    // Retrieve the data from the database
    $sql_users = 'SELECT COUNT(*) as count FROM user_details';
    $result_users = $conn->query($sql_users);
    $user_total = $result_users->fetch_assoc();
    
    $sql_owners = 'SELECT COUNT(*) as count FROM owner_status';
    // $sql_owners = 'SELECT COUNT(*) as count FROM owner_status WHERE status = "active"';
    $result_owners = $conn->query($sql_owners);
    $owner_total = $result_owners->fetch_assoc();
    
    $sql_pets = 'SELECT COUNT(*) as count FROM pet_status WHERE status = "available"';
    $result_pets = $conn->query($sql_pets);
    $pet_total = $result_pets->fetch_assoc();
    
    $sql_adopted = 'SELECT COUNT(*) as count FROM pet_status WHERE status = "adopted"';
    $result_adopted = $conn->query($sql_adopted);
    $adopted_total = $result_adopted->fetch_assoc();
    
    $conn->close();
?>

<script>
   const pieChart = document.getElementById('pieChart');
   
   new Chart(pieChart, {
      type: 'doughnut',
      data: {
         labels: [
            'Users',
            'owners',
            'Pets',
            'Adopted Pets'
          ],
          datasets: [{
            label: 'Information',
            data: [
               <?=$user_total['count']?>, 
               <?=$owner_total['count']?>, 
               <?=$pet_total['count']?>, 
               <?=$adopted_total['count']?>,
            ],
            backgroundColor: [
               'rgba(255, 99, 132, .8)',
               'rgba(54, 162, 235, .8)',
               'rgba(255, 205, 86, .8)',
               'rgba(162, 205, 86, .8)'
            ],
            borderColor: '#fff',
            hoverOffset: 1
          }]
      },
      options: {
         plugins: {
            legend: {
               position: 'left',
            }
         }
      }
   });
</script>