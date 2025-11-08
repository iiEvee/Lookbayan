<?php 
include 'session.php';
    $title = "Contact Us"; 
    $logoSrc = "logoo.png"; 
    $faviconSrc = "logoo.png";

    require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $conn->real_escape_string(trim($_POST['name']));
    $email   = $conn->real_escape_string(trim($_POST['email']));
    $subject = $conn->real_escape_string(trim($_POST['subject']));
    $message = $conn->real_escape_string(trim($_POST['message']));

    $sql = "INSERT INTO messages (name, email, subject, message) 
            VALUES ('$name', '$email', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Thank you for reaching out! We will get back to you soon.');</script>";
    } else {
        echo "<script>alert('Sorry, there was an error. Please try again later.');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="contactus.css">
    <link rel="icon" type="image/x-icon" href="<?php echo $faviconSrc; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        <li><a href="contactus.php" class="active">Contact us</a></li>
    </ul>
    <?php
    $default_image = 'uploads/default.png';
    $user_image = isset($_SESSION['user_image']) ? 'uploads/' . htmlspecialchars($_SESSION['user_image']) : $default_image;
    $user_name = isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : '';
    ?>
    <?php if ($user_name): ?>
        <div class="user-dropdown">
            <button class="user-icon">
                <img src="<?= $user_image ?>" alt="User" class="profile-pic">
                <?= $user_name ?>
            </button>
            <div class="dropdown-content">
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    <?php else: ?>
        <a href="logsig.php" class="btn book-btn">Book Now</a>
    <?php endif; ?>
</nav>


<!-- Background Video Wrapper -->
<div class="contactus-background">
    <video autoplay muted loop id="contactVideo">
        <source src="falls.mp4" type="video/mp4">
        Your browser does not support HTML5 video.
    </video>
    <!-- Overlay -->
    <div class="contactus-overlay"></div>
</div>

<!-- Contact Us Section -->
<section class="contact-section">
    <div class="contact-container">
        <div class="contact-info">
            <h2>Get in Touch with Us</h2>
            <p>We’d love to hear from you! Whether you have a question about our tours, bookings, or want to share your travel story feel free to reach out.</p>
            <ul>
                <li><i class="fas fa-phone"></i> 0961 285 3038</li>
                <li><i class="fas fa-envelope"></i> lookbayan@gmail.com</li>
                <li><i class="fas fa-map-marker-alt"></i> Cavite, Philippines</li>
                <li><i class="fas fa-clock"></i> Monday to Saturday | 9:00 AM – 6:00 PM</li>
            </ul>
            <div class="contact-socials">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>

        <div class="contact-form">
            <form action="#" method="POST">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <input type="text" name="subject" placeholder="Subject" required>
                <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
                <button type="submit" class="btn">Send Message</button>
            </form>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="footer-container">
        <div class="footer-logo">
            <img src="<?php echo $logoSrc; ?>" alt="Lookbayan Logo"> 
        </div>
        <div class="footer-about">
            <h3>About</h3>
            <p>
                Lookbayan Travel and Tours offers premium travel experiences to local destinations in the Philippines. 
                We provide curated trips and essential info to help you discover the culture and beauty of each place.
            </p>
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

</body>
</html>