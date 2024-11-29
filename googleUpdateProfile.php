<!DOCTYPE html>
<html lang="en">
<?php

include "./db/db_con.php";
include "./function/fetch_data.php";
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adoption</title>
    <link rel="icon" href="assets/adopt-logo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/editMyAccount.css">
    <link rel="stylesheet" href="css/verifyAccount.css">
    <link rel="stylesheet" href="css/googleUpdateProfile.css">
    <!-- Font Awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>

<body>
    <main>
        <div>
            <div class="img">
                <img src="assets/mobile-logo.png" alt="Logo">
            </div>
            <div class="heading">
                <h2>Complete Basic Information</h2>

                <div class="invalid-feedback" id="missing-feedback"></div>






            </div>
            <form id="checking" action="./function/googleInsert.php" method="post">
                <div class="input">
                    <div class="card-two-inputs">
                        <div class="card-input">
                            <span for="firstname">First Name <span class="alert-red">*</span></span>
                            <input type="text" class="firstname" id="firstname" name="firstname" value="<?php echo $firstname; ?>" required />
                            <div class="invalid-feedback" id="firstname-feedback"></div>
                        </div>

                        <div class="card-input">
                            <span for="lastname">Last Name <span class="alert-red">*</span></span>
                            <input type="text" class="lastname" id="lastname" name="lastname" value="<?php echo $lastname; ?>" required />
                            <div class="invalid-feedback" id="lastname-feedback"></div>
                        </div>
                    </div>

                    <div class="card-two-inputs">
                        <div class="register-input">
                            <span for="email">Email <span class="alert-red">*</span></span>
                            <input type="text" class="email" id="email" name="email" value="<?php echo $email;  ?>" required />
                            <div class="invalid-feedback" id="email-feedback"></div>
                        </div>

                        <div class="register-input">
                            <span for="phonenumber">Phone Number <span class="alert-red">*</span></span>
                            <input type="text" class="contact" id="contact" name="contact" placeholder="ex. 09123456789" required maxlength="11" />
                            <div class="invalid-feedback" id="contact-feedback"></div>
                        </div>
                    </div>


                    <div class="card-three-inputs">
                        <div class="register-input">
                            <span for="province">Province </span>
                            <select name="province" id="province">
                                <option value="Naga Cebu">Naga Cebu</option>

                            </select>
                        </div>


                        <div class="register-input">
                            <span for="city">City</span>

                            <select name="city" id="city">
                                <option value="Naga City">Naga City</option>
                            </select>
                        </div>

                        <div class="register-input">
                            <span for="barangay">Barangay <span class="alert-red"></span></span>
                            <select name="barangay" id="barangay">
                            <option value="Banaybanay">Banaybanay</option>
                                <option value="Cagbao">Cagbao</option>
                                <option value="Cogon">Cogon</option>
                                <option value="Lupigue">Lupigue</option>
                                <option value="Poblacion I">Poblacion I</option>
                                <option value="Poblacion II">Poblacion II</option>
                                <option value="San Isidro">San Isidro</option>
                                <option value="San Juan">San Juan</option>
                                <option value="San Rafael">San Rafael</option>
                                <option value="Tapon">Tapon</option>
                                <option value="Valencia">Valencia</option>
                                <option value="Victoria">Victoria</option>
                                <option value="Punod">Punod</option>
                                <option value="Malobago">Malobago</option>
                                <option value="Barangay North Poblacion">Barangay North Poblacion</option>
                                <option value="Barangay South Poblacion">Barangay South Poblacion</option>
                                <option value="Barangay Cantuman">Barangay Cantuman</option>
                                <option value="Barangay Inayagan">Barangay Inayagan</option>
                                <option value="Barangay Langtad">Barangay Langtad</option>
                                <option value="Barangay Linao">Barangay Linao</option>
                                <option value="Barangay Mainit">Barangay Mainit</option>
                                <option value="Barangay Pajo">Barangay Pajo</option>
                                <option value="Barangay Pangdan">Barangay Pangdan</option>
                                <option value="Barangay Quijano">Barangay Quijano</option>
                                <option value="Barangay Sangi">Barangay Sangi</option>
                                <option value="Barangay Soro-soro">Barangay Soro-soro</option>
                                <option value="Barangay Tangke">Barangay Tangke</option>
                                <option value="Barangay Upper Sangi">Barangay Upper Sangi</option>
                                <option value="Poblacion">Poblacion</option>
                                <option value="Tulic">Tulic</option>
                                <option value="Sangi">Sangi</option>
                                <option value="Lanas">Lanas</option>
                                <option value="Biasong">Biasong</option>
                                <option value="Tayud">Tayud</option>
                                <option value="Pajo">Pajo</option>
                                <option value="Pooc">Pooc</option>
                                <option value="Duljo">Duljo</option>
                                <option value="Bunbon">Bunbon</option>
                                <option value="Cantipla">Cantipla</option>
                                <option value="Inayagan">Inayagan</option>
                                <option value="Limpapa">Limpapa</option>
                            </select>
                        </div>
                    </div>



                    <div class="register-input">
                        <span for="street">Street <span class="alert-red">*</span></span>
                        <input type="text" name="street" id="street" class="address" required />
                        <div class="invalid-feedback" id="street-feedback"></div>
                    </div>
                    <div class="form-btn">
                        <a href="./function/logout.php" class="primary">Cancel</a>
                        <button type="submit" id="login-button" class="submit-btn">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </main>


    <!-- SCRIPTS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./js/googleUpdateProfile.js"></script>

</body>

</html>