<?php

include "../db/db_con.php";
include "../include/date.php";

// Check if all form data is set
if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['contact']) && isset($_POST['street']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {

    // Function to validate form data
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Function to encrypt password
    function encrypt($value, $key) {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($value, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        return base64_encode($iv . $encrypted);
    }

    // Get email and check if it already exists
    $email = validate($_POST['email']);
    $sql = "SELECT * FROM user_account WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Email is already registered, display error message with styling
        echo "
        <html>
        <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f7f7f7;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .error-container {
                background-color: #f44336;
                color: white;
                padding: 20px;
                border-radius: 8px;
                text-align: center;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            .error-container h1 {
                margin: 0;
                font-size: 24px;
            }
            .error-container p {
                font-size: 18px;
                margin: 10px 0;
            }
            .error-container a {
                color: white;
                text-decoration: underline;
                font-weight: bold;
            }
        </style>
        </head>
        <body>
            <div class='error-container'>
                <h1>Email Already Registered</h1>
                <p>The email address you entered is already associated with an existing account.</p>
                <p>Please try using a different email address.</p>
                <p>Click <a href='http://localhost/QCiSagip-main/signup.php'>here</a> to go back and try again.</p>
            </div>
        </body>
        </html>
        ";
        exit();
    }

    // Generate a unique user ID
    $user_id = uniqid('user_', false);

    // Collect other form values
    $first_name = validate($_POST['firstname']);
    $last_name = validate($_POST['lastname']);
    $password = validate($_POST['password']);
    $confirmpassword = validate($_POST['confirm_password']);
    $contact = validate($_POST['contact']);
    $province = validate($_POST['province']);
    $city = validate($_POST['city']);
    $barangay = validate($_POST['barangay']);
    $street = validate($_POST['street']);
    $full_address = $street . ', Brgy. ' . $barangay . ', ' . $city . ', ' . $province;

    $user = "user";
    date_default_timezone_set('Asia/Manila');
    $date_today = date('Y-m-d H:i:s');
    $status = "Not Verified";

    $key = 'QCIsagip'; // Unique, secret key for encryption

    // Insert data into user_details table
    $stmt = mysqli_prepare($conn, "INSERT INTO `user_details` (`user_id`, `firstname`, `lastname`, `email`, `emailStatus`, `contact`, `contactStatus`, `address`, `date_created`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssssssss", $user_id, $first_name, $last_name, $email, $status, $contact, $status, $full_address, $date_today);
    if (!mysqli_stmt_execute($stmt)) {
        echo "Unable to insert user details.";
        exit();
    }

    // Encrypt the password
    $encryptedPassword = encrypt($password, $key);
    
    // Insert data into user_account table
    $stmt = mysqli_prepare($conn, "INSERT INTO `user_account`(`account_id`, `email`, `password`, `user_type`, `keyencrypt`) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssss", $user_id, $email, $encryptedPassword, $user, $key);
    if (!mysqli_stmt_execute($stmt)) {
        echo "Unable to insert user account.";
        exit();
    }

    // If everything is successful, send a confirmation email and redirect
    include "../function/sendemail.php";
    sendEmail($email, $first_name, $last_name, $user_id);
    
    // Redirect to a success page
    header("Location: ../signupcomplete.php");
    exit(); // Ensure no further code is executed

} else {
    echo "Please fill in all required fields.";
    exit();
}
?>
