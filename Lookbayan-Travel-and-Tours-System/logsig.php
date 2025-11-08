<?php
include 'session.php';
$logoSrc = "logoo.png";
$email_input = isset($_SESSION['login_email_temp']) ? htmlspecialchars($_SESSION['login_email_temp']) : '';
if (isset($_SESSION['login_email_temp']) && basename($_SERVER['PHP_SELF']) === 'logsig.php') {
  $email_input = $_SESSION['login_email_temp'];
} else {
  $email_input = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="logsig.css" />
    <link rel="shortcut icon" type="image/x-icon" href="logoo.png">
    <title>Lookbayan</title>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="nav-logo">
            <img src="<?php echo $logoSrc; ?>" alt="Lookbayan Logo">
            <span>Lookbayan</span>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="destinations.php">Destinations</a></li>
            <li><a href="aboutus.php">About us</a></li>
            <li><a href="contactus.php">Contact us</a></li>
        </ul>
    </nav>

    <div class="page-wrapper">
        <video autoplay loop muted playsinline class="video-bg">
            <source src="Sunset.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <!-- Login & Signup Form -->
        <div class="container" id="container">
      <div class="form-container sign-up">
      <form action="signup.php" method="POST" autocomplete="off">
        <h1>Create Account</h1>
        <input type="text" name="signup_name" placeholder="Name" required />
        <input type="email" name="signup_email" placeholder="Email" required />
        <div class="password-wrapper">
          <input type="password" id="signupPassword" name="signup_password" placeholder="Password" required />
          <i class="fas fa-eye toggle-password" toggle="#signupPassword"></i>
        </div>

        <div class="password-wrapper">
          <input type="password" id="confirmPassword" name="confirm_password" placeholder="Re-type Password" required />
          <i class="fas fa-eye toggle-password" toggle="#confirmPassword"></i>
        </div>
        <a href="agency_signup.php" class="agency-signup-link">Sign up as travel agency</a>
        <button class="btns" type="submit">Sign Up</button>
        </form>

      </div>
      <div class="form-container sign-in">
      <form action="login.php" method="POST" autocomplete="off">
        <h1>Login</h1>
        <input type="email" name="login_email" placeholder="Email" required value="<?= $email_input ?>">
        <div class="password-wrapper">
          <input type="password" id="loginPassword" name="login_password" placeholder="Password" required />
          <i class="fas fa-eye toggle-password" toggle="#loginPassword"></i>
        </div>
        <a href="#">Forgot Your Password?</a>
        <button class="btns" type="submit">Login</button>
        </form>

      </div>
      <div class="toggle-container">
        <div class="toggle">
          <div class="toggle-panel toggle-left">
            <h1>Greetings, Traveler!</h1>
            <p>Already have an account? Login and start your journey with us</p>
            <button class="hidden" id="login">Login Here</button>
          </div>
          <div class="toggle-panel toggle-right">
            <h1>Welcome!</h1>
            <p>
            To plan and book trips with us, you need an account first
            </p>
            <button class="hidden" id="register">Sign Up Here</button>
          </div>
        </div>
      </div>
    </div>
    </div>


        <!-- Footer -->
        <footer class="footer">
        <div class="footer-container">
            <div class="footer-logo">
                <img src="logoo.png" alt="Lookbayan Logo"> 
            </div>
            <div class="footer-about">
                <h3>About</h3>
                <p>Lookbayan Travel and Tours will provide a convenient and premium travel and tour service for local destinations in the Philippines. 
                    Lookbayan Travel and Tours offers tourists destinations that they would love and relax in. 
                    We also provide essential information to clients so that they are familiar with the culture of their chosen places.</p>
            </div>
            <div class="footer-links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="destinations.php">Destinations</a></li>
                    <li><a href="aboutus.php">About us</a></li>
                    <li><a href="contactus.php">Contact us</a></li>
                </ul>
            </div>
            <div class="footer-contact">
                <h3>Contact Us</h3>
                <p>📞 0961 285 3038</p>
                <p>📍 Manila, Philippines</p>
                <div class="footer-socials">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer> 

    <script>
        const container = document.getElementById("container");
        const registerBtn = document.getElementById("register");
        const loginBtn = document.getElementById("login");

        registerBtn.addEventListener("click", () => {
        container.classList.add("active");
        });

        loginBtn.addEventListener("click", () => {
        container.classList.remove("active");
        });

        document.querySelectorAll('.toggle-password').forEach(function (eyeIcon) {
            eyeIcon.addEventListener('click', function () {
              const input = document.querySelector(this.getAttribute('toggle'));
              const isPassword = input.getAttribute('type') === 'password';
              input.setAttribute('type', isPassword ? 'text' : 'password');
              this.classList.toggle('fa-eye');
              this.classList.toggle('fa-eye-slash');
            });
          });

            // Password match check
          document.querySelector('form[action="signup.php"]').addEventListener('submit', function (e) {
            const pw1 = document.getElementById('signupPassword').value;
            const pw2 = document.getElementById('confirmPassword').value;
            if (pw1 !== pw2) {
              e.preventDefault();
              alert("Passwords do not match!");
            }
          });
    </script>
</body>
</html>