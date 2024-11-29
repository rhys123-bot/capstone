$(document).ready(function () {
  // Disable submit button on page load
  $("#signup-button").prop('disabled', true);

  // Toggle visibility of password input
  const passwordInput = document.getElementById("password");
  const togglePassword = document.querySelector(".password-toggle");

  togglePassword.addEventListener("click", function () {
    const type =
      passwordInput.getAttribute("type") === "password" ? "text" : "password";
    passwordInput.setAttribute("type", type);
    this.querySelector("i").classList.toggle("fa-eye");
    this.querySelector("i").classList.toggle("fa-eye-slash");
  });

  // Toggle visibility of confirm password input
  const confirmpasswordInput = document.getElementById("confirm-password");
  const confirmtogglePassword = document.querySelector(".confirmpassword-toggle");

  confirmtogglePassword.addEventListener("click", function () {
    const type =
      confirmpasswordInput.getAttribute("type") === "password"
        ? "text"
        : "password";
    confirmpasswordInput.setAttribute("type", type);
    this.querySelector("i").classList.toggle("fa-eye");
    this.querySelector("i").classList.toggle("fa-eye-slash");
  });

  // Email validation with AJAX
  $(document).ready(function () {
    // Disable submit button on page load
    $("#signup-button").prop('disabled', true);
  
    // Email validation with AJAX
 // Email validation with AJAX
$("#user-email").on("input", function () {
  var email = $(this).val();

  // Basic email regex check for format validation
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  // If the email format is invalid
  if (!emailRegex.test(email) && email !== "") {
    // Show the validation feedback and disable submit button
    $("#user-email").addClass("is-invalid");
    $("#email-feedback").html("Please enter a valid email address.");
    $("#signup-button").prop('disabled', true);
  } else {
    // If the email format is valid, remove invalid class and feedback
    $("#user-email").removeClass("is-invalid");
    $("#email-feedback").html("");

    // Check with the server only if the email format is correct
    $.ajax({
      url: "../function/CheckingSignup.php",  // URL to your PHP script
      type: "POST",
      data: { email: email },
      success: function (response) {
        console.log("Response from server:", response);

        if (response === "exists_email") {
          // If the email already exists, show an error message
          $("#user-email").addClass("is-invalid");
          $("#email-feedback").html("Email is already in use.");
          $("#signup-button").prop('disabled', true);  // Disable submit button
        } else if (response === "invalid_email_format") {
          // If the email format is invalid (this case should be covered earlier in the code)
          $("#user-email").addClass("is-invalid");
          $("#email-feedback").html("Please enter a valid email address.");
          $("#signup-button").prop('disabled', true);
        } else if (response === "email_available") {
          // If the email is not in use, remove invalid class and feedback
          $("#user-email").removeClass("is-invalid");
          $("#email-feedback").html("");
          enableSubmitButton();  // Enable submit button when all inputs are valid
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error: ", status, error);
      }
    });
  }
});

// Enable submit button only when all fields are valid
function enableSubmitButton() {
  var allValid = true;

  // Check other fields here to see if they are valid (Example: password, username, etc.)
  $(".input-field").each(function () {
    if ($(this).hasClass("is-invalid") || $(this).val() == "") {
      allValid = false;
    }
  });

  if (allValid) {
    $("#signup-button").prop('disabled', false);  // Enable submit button
  }
}

  

  // Contact validation with AJAX
  $("#contact").on("input", function () {
    var contact = $(this).val();
  
    // Check if the contact is 11 digits and contains only numbers
    if (contact.length !== 11 || !/^\d+$/.test(contact)) {
      // If invalid, show the feedback message and disable the submit button
      $("#contact").addClass("is-invalid");
      $("#contact-feedback").html("Phone number must be 11 digits long.");
      $("#signup-button").prop('disabled', true);
      return;
    }
  
    // If valid, remove the invalid class and feedback message
    $("#contact").removeClass("is-invalid");
    $("#contact-feedback").html("");
  
    // Perform AJAX check only if the number is valid (length 11 and numeric)
    $.ajax({
      url: "../function/CheckingSignup.php",
      type: "post",
      data: { contact: contact },
      success: function (response) {
        console.log("Response from server:", response);
        if (response == "exists_contact") {
          // If contact exists, show the feedback and disable the submit button
          $("#contact").addClass("is-invalid");
          $("#contact-feedback").html("Phone number is already in use.");
          $("#signup-button").prop('disabled', true);
        } else {
          // If valid, remove invalid class and feedback
          $("#contact").removeClass("is-invalid");
          $("#contact-feedback").html("");
          enableSubmitButton(); // Enable the submit button if all inputs are valid
        }
      },
    });
  });
  

  // Password validation
 // Password validation
$("#password").on("input", function () {
  var password = $(this).val();
  var confirmPassword = $("#confirm-password").val();
  var passwordRegex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;

  // Password length validation
  if (password.length < 8) {
    $("#password").addClass("is-invalid");
    $("#password-feedback").html("Password must be at least 8 characters long.");
    $("#signup-button").prop('disabled', true);
  } else {
    $("#password").removeClass("is-invalid");
    $("#password-feedback").html("");
  }

  // Password strength validation (upper case and digits)
  if (!passwordRegex.test(password)) {
    $("#password").addClass("is-invalid");
    $("#password-strong").html("Password must contain at least one uppercase letter and one digit.");
    $("#signup-button").prop('disabled', true);
  } else {
    $("#password").removeClass("is-invalid");
    $("#password-strong").html("");
  }

  // Password and confirm password matching
  if (confirmPassword !== "" && password !== confirmPassword) {
    $("#confirm-password").addClass("is-invalid");
    $("#confirm-password-feedback").html("Passwords do not match.");
    $("#signup-button").prop('disabled', true);
  } else {
    $("#confirm-password").removeClass("is-invalid");
    $("#confirm-password-feedback").html("");
  }

  enableSubmitButton();
});

  // Enable submit button if all fields are valid
  function enableSubmitButton() {
    if (
      !$("#email").hasClass("is-invalid") &&
      !$("#contact").hasClass("is-invalid") &&
      !$("#password").hasClass("is-invalid") &&
      !$("#confirm-password").hasClass("is-invalid")
    ) {
      $("#signup-button").prop('disabled', false);
    }
  }

  // Handle form submission
  $("#checking").submit(function (event) {
    event.preventDefault();
    $("#signup-button").prop('disabled', true);

    // Ensure no invalid fields before submitting
    if (
      $("#email").hasClass("is-invalid") ||
      $("#contact").hasClass("is-invalid") ||
      $("#password").hasClass("is-invalid") ||
      $("#confirm-password").hasClass("is-invalid")
    ) {
      event.preventDefault();
      $("#signup-button").prop('disabled', false);
      return;
    }

    setTimeout(function () {
      $("#signup-button").prop('disabled', false);
    }, 7000);

    this.submit();
  });
});
