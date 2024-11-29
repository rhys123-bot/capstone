<?php
// Include your database connection
include "../db/db_con.php";

// Get the email from the POST data
$email = $_POST['email'];

// Check if the email is empty
if (empty($email)) {
    echo "invalid_email_format";
    exit;
}

// Prepare and execute the query to check if the email exists
$query = "SELECT email FROM user_details WHERE email = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

// Check if the email already exists
if (mysqli_stmt_num_rows($stmt) > 0) {
    // Email exists, respond back
    echo "exists_email";
} else {
    // Email is available, proceed with inserting the new user
    echo "email_available";
}

mysqli_stmt_close($stmt);
?>
