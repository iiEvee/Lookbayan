<?php 
include 'session.php';
    $title = "Home"; 
    $videoSrc = "waves.mp4"; 
    $logoSrc = "logoo.png"; 
    $faviconSrc = "logoo.png";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/x-icon" href="<?php echo $faviconSrc; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="hero">
        <!-- Navigation Bar -->
        <nav class="navbar">
            <div class="nav-logo">
                <img src="logoo.png" alt="Lakbayan Logo">
                <span>Lookbayan</span>
            </div>
            <ul class="nav-links">
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="destinations.php">Destinations</a></li>
                <li><a href="aboutus.php">About us</a></li>
                <li><a href="contactus.php">Contact us</a></li>
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

        <video autoplay loop muted playsinline>
            <source src="<?php echo $videoSrc; ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="overlay"></div>

        <div class="content">
            <h1>EXPLORE WITHOUT LIMITS</h1>
            <p>Your travel starts here, with us.</p>
            <a href="#destinations" class="btn">Explore Now</a>
        </div>
    </div>

    <section class="travel-info">
    <div class="container">
        <div class="travel-info-content">
            <img src="logoo.png" alt="Lindela Travel and Tours" class="travel-image">
            <div class="travel-text">
                <h2><span class="highlight">Lookbayan</span> Travel and Tours</h2>
                <p>
                    The most trusted travel agency in the Cavite. Founded on 2024, 
                    <strong>Lookbayan Travel and Tours</strong> has organized countless trips, helping 
                    travelers reach their destinations and create lasting memories.
                </p>
                <p>
                    For us, travel is more than reaching a destination. Through our tours, we inspire 
                    people to chase their dreams, explore the world’s beauty, and leave a positive, 
                    lasting impact on communities.
                </p>
                <div class="stats">
                </div>
                <a href="aboutus.php" class="btns">Know More</a>
            </div>
        </div>
    </div>
</section>

<!-- Destinations Section -->
<div class="destinations" id="destinations">
    <!-- Background Video -->
    <video autoplay muted loop class="background-video">
        <source src="biker.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Overlay -->
    <div class="overlay"></div>

    <div class="destinations-content">
        <h2>Destinations</h2>
        <p>Explore new horizons and cultures around the Philippines.</p>

        <div class="destinations-container">
            <div class="destination">
                <img src="Baguio.jpg" alt="Baguio">
                <span>BAGUIO</span>
            </div>
            <div class="destination">
                <img src="LaUnion.jpg" alt="La Union">
                <span>LA UNION</span>
            </div>
            <div class="destination">
                <img src="Ilocos.jpg" alt="Ilocos">
                <span>ILOCOS</span>
            </div>
            <div class="destination">
                <img src="Dingalan.jpg" alt="Dingalan">
                <span>DINGALAN</span>
            </div>
        </div>

        <a href="destinations.php" class="explore-btn">Explore Destinations</a>
    </div>
</div>

<footer class="footer">
    <div class="footer-container">
        <div class="footer-logo">
            <img src="logoo.png" alt="Lakbayan Logo"> 
        </div>
        
        <div class="footer-about">
            <h3>About</h3>
            <p>
                Lookbayan Travel and Tours will provide a convenient and premium travel and tour service for local destinations in the Philippines. 
                Lookbayan Travel and Tours offers tourists destinations that they would love and relax in. 
                We also provide essential information to clients so that they are familiar with the culture of their chosen places.
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