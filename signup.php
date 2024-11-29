<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include_once('head.php');
  ?>
  <link rel="stylesheet" href="css/signup.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
  <script src="./js/signup.js" defer></script>
</head>

<body>
  <?php
  include_once('navigation.php');
  ?>
  <!-- Signin -->
  <div class="register-container">
    <div class="register">

      <div class="register-header">
        <h2 class="register-title">SIGN UP</h2>
        <p class="register-desc small">
          Text Field that has (<span class="alert-red">*</span>) is required
        </p>
        <div class="invalid-feedback" id="missing-feedback"></div>



      </div>

      <div class="register-content">

        <form id="checking" action="./function/signup.php" method="post" class="register-form">

          <div class="register-two-inputs">

            <div class="register-input">
              <span for="firstname" class="small">First Name <span class="alert-red">*</span></span>
              <input type="text" class="firstname" id="firstname" name="firstname" required />
            </div>

            <div class="register-input">
              <span for="lastname" class="small">Last Name <span class="alert-red">*</span></span>
              <input type="text" class="lastname" id="lastname" name="lastname" required />
            </div>

          </div>

          <div class="register-two-inputs">

            <div class="register-input">
              <span for="email" class="small">Email <span class="alert-red">*</span></span>
              <input type="text" class="email" id="email" name="email" required />
              <div class="invalid-feedback" id="email-feedback"></div>

            </div>

            <div class="register-input">
              <span for="phonenumber" class="small">Phone Number <span class="alert-red">*</span></span>
              <input type="text" class="contact" id="contact" name="contact" placeholder="ex. 09123456789" required maxlength="11" />
              <div class="invalid-feedback" id="contact-feedback"></div>
            </div>

          </div>


          <div class="register-three-inputs">
            <div class="register-input">
              <span for="province" class="small">Province </span>
              <select name="province" id="province">
                <option value="Naga Cebu">Naga Cebu</option>
                <option value="Carcar Cebu">Carcar Cebu</option>
                <option value="Mingalina Cebu">Mingalina Cebu</option>
              </select>
            </div>


            <div class="register-input">
              <span for="city" class="small">City</span>

              <select name="city" id="city">
                <option value="Naga City">Naga City</option>
                <option value="Carcar City">Carcar City</option>
                <option value="Mingalina City">Mingalina Municipality</option>
              </select>
            </div>

            <div class="register-input">
              <span for="barangay" class="small">Barangay <span class="alert-red"></span></span>
              <select name="barangay" id="barangay">
              <option value="Carcar (Poblacion)">Carcar (Poblacion)</option>
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
            <span for="street" class="small">Street <span class="alert-red">*</span></span>
            <input type="text" name="street" id="street" class="address" required />
          </div>



          <div class="register-two-inputs">

            <div class="register-input password-all">

              <span for="password" class="small">Password <span class="alert-red">*</span></span>
              <input type="password" id="password" class="password" name="password" required />

              <span class="password-toggle">
                <i class="fa fa-eye-slash"></i>
              </span>

              <div class="invalid-feedback" id="password-feedback"><span style="color: black;opacity: .8;">Password must be at least 8 characters long with at least one uppercase letter, one digit</span>
              </div>
              <div class="invalid-feedback" id="password-strong"></div>
            </div>

            <div class="register-input password-all">
              <span for="password" class="small">Repeat Password <span class="alert-red">*</span></span>
              <input type="password" id="confirm-password" class="confirm-password" name="confirm_password" required />
              <span class="confirmpassword-toggle">
                <i class="fa fa-eye-slash"></i>
              </span>
              <div class="invalid-feedback" id="confirm-password-feedback"></div>

            </div>

          </div>



          <button type="submit" id="signup-button">SIGN UP</button>

          <p class="small" style="text-align: center">
            Already have an account? Click
            <a href="signin.php" class="primary">Here!</a>
          </p>

        </form>
      </div>
    </div>
  </div>




  <?php
  include_once('footer.php')
  ?>
</body>

</html>