<!-- Edit Modal  -->
<div class="modal edit-modal ">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Edit Basic Information</h2>
            <span class="modal-close edit-btn-close">&times;</span>
        </div>


        <?php


        $address = $row['address'];
        $components = extractAddressComponents($address);
        $street = $components['street'];

        $subdivision = $components['subdivision'];
        $barangay = $components['barangay'];
        $barangay = str_replace('Brgy. ', '', $barangay);

        if (!empty($subdivision)) {
            $address_field =  $subdivision;
        } else {
            $address_field = $street;
        }

        ?>
        <div class="modal-body">
            <!-- <div class="img">
                    <img src="assets/mobile-logo.png" alt="Logo">
                </div> -->
            <div class="heading">
                <div class="invalid-feedback" id="missing-feedback"></div>
                <div class="invalid-feedback" id="firstname-feedback"></div>
                <div class="invalid-feedback" id="lastname-feedback"></div>
                <div class="invalid-feedback" id="email-feedback"></div>
                <div class="invalid-feedback" id="contact-feedback"></div>
                <div class="invalid-feedback" id="street-feedback"></div>
            </div>
            <form id="checking" action="function/updateProfile.php" method="post">
                <div class="input">
                    <div class="card-two-inputs">
                        <div class="card-input">
                            <span for="firstname">First Name <span class="alert-red">*</span></span>
                            <?php echo '<input type="text" class="firstname" id="firstname" value="' . $row["firstname"] . '" name="firstname" required />'; ?>
                        </div>

                        <div class="card-input">
                            <span for="lastname">Last Name <span class="alert-red">*</span></span>
                            <?php echo '<input type="text" class="lastname" id="lastname" value="' . $row["lastname"] . '" name="lastname" required />';
                            ?>
                        </div>
                    </div>

                    <div class="card-two-inputs">
                        <div class="register-input">
                            <span for="email">Email <span class="alert-red">*</span></span>
                            <?php if (isset($_SESSION['google_user']) && $_SESSION['google_user'] == true) {
                                echo '<select name="email" class="email" id="email">
                                    <option value="' . $row["email"] . '">' . $row["email"] . '</option>
                                    </select>';
                            } else {
                                echo '<input type="text" class="email" id="email" value="' . $row["email"] . '"  name="email" required />';
                            } ?>

                        </div>

                        <div class="register-input">
                            <span for="phonenumber">Phone Number <span class="alert-red">*</span></span>
                            <?php echo '<input type="text" class="contact" id="contact" value="' . $row["contact"] . '"   name="contact" placeholder="ex. 09123456789" required maxlength="11" />'; ?>
                        </div>
                    </div>


                    <div class="card-three-inputs">
                        <div class="register-input">
                            <span for="province">Province </span>
                            <select name="province" id="province">
                                <option value="Cebu Naga">Cebu Naga</option>

                            </select>
                        </div>


                        <div class="register-input">
                            <span for="city">City</span>

                            <select name="city" id="city">
                                <option value="Cebu City">Naga City</option>
                            </select>
                        </div>

                        <div class="register-input">
                            <span for="barangay">Barangay <span class="alert-red"></span></span>
                            <select name="barangay" id="barangay">
                                <?php echo '<option value="' . $barangay . '">' . $barangay . '</option>'; ?>
                                <<option value="Carcar (Poblacion)">Carcar (Poblacion)</option>
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
                        <?php
                        echo '<input type="text" name="street" id="street" class="address" value="' . $address_field . '" required />';

                        ?>
                    </div>

                    <div class="form-btn">
                        <!-- <a href="myAccount.php?page=account" class="primary">Cancel</a> -->
                        <button type="submit" id="login-button" class="submit-btn">Submit</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>