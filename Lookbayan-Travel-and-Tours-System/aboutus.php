<?php 
include 'session.php';
    $title = "About Us"; 
    $logoSrc = "logoo.png"; 
    $faviconSrc = "logoo.png";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="aboutus.css">
    <link rel="icon" type="image/x-icon" href="<?php echo $faviconSrc; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="nav-logo">
            <img src="<?php echo $logoSrc; ?>" alt="Lakbayan Logo">
            <span>Lookbayan</span>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="destinations.php">Destinations</a></li>
            <li><a href="aboutus.php" class="active">About us</a></li>
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

    <!-- About Us Section -->
    <section class="about-us-section">
    <div class="about-us-background">
            <!-- Background Video -->
    <video autoplay muted loop class="about-bg-video">
        <source src="balloons.mp4" type="video/mp4">
        Your browser does not support HTML5 video.
    </video>

        <div class="about-bg-overlay"></div>

        <div class="about-us-container">
            <div class="about-image">
                <img src="logoo.png" alt="About Lookbayan">
            </div>
            <div class="about-text">
                <h2>About <span class="highlight">Lookbayan</span></h2>
                <p>
                    <strong class="highlight">Lookbayan</strong> <strong>Travel and Tours</strong> was founded with a mission to make travel more meaningful and accessible to everyone in the Philippines. 
                    We specialize in local tourism, offering curated tours, immersive virtual experiences, and a seamless booking process. With a passion for showcasing 
                    the beauty of the Philippines from mountain getaways to tropical beaches our team ensures you get not only a trip, but a journey filled with unforgettable memories.
                </p>
                <p>
                    Trust, reliability, and authentic experiences are the core values that drive our services. Whether you’re planning a family vacation, 
                    a romantic escape, or an adventurous solo trip, Lookbayan has got you covered.
                </p>
                <a href="contactus.php" class="btn">Contact Us</a>
            </div>
        </div>
    </div>
    </section>

    <div class="mission-vision-section">
        <div class="mission">
            <h2>Our Mission</h2>
            <p>
                At <strong>Lookbayan Travel and Tours</strong>, our mission is to <strong>bridge the gap between travelers and the cultural, historical, and natural wonders of Philippines</strong> by offering a dynamic, user-friendly online platform. We are committed to <strong>promoting local tourism</strong> by making travel planning more efficient, informative, and enjoyable for all.
                Through our <strong>seamless booking system</strong>, engaging content, and <strong>cutting-edge virtual tours</strong>, we aim to <strong>inspire a deeper appreciation for the province’s heritage</strong> from its scenic coastal towns to its storied revolutionary landmarks.
                We believe that travel should not only be about visiting places, but also about <strong>building connections</strong>, understanding communities, and creating unforgettable experiences. By combining <strong>technology and hospitality</strong>, we empower both local and international travelers to explore Philippines with confidence, ease, and a sense of wonder.
            </p>
        </div>
        <div class="vision">
            <h2>Our Vision</h2>
            <p>
                We envision <strong>Lookbayan</strong> as the <strong>premier digital gateway to Philippines tourism experience</strong> a platform that redefines the way people discover, explore, and engage with local destinations. Our goal is to be at the forefront of a <strong>digital tourism revolution</strong>, where travelers can immerse themselves in the <strong>rich Filipino heritage</strong>, even before setting foot in the province.
                As a <strong>trailblazer in virtual tourism</strong>, we strive to continuously innovate and expand our services to meet the evolving needs of the modern traveler. Through collaborations with local communities, businesses, and tourism agencies, we aim to <strong>foster sustainable travel</strong>, support local economies, and <strong>promote responsible tourism</strong> that respects both people and places.
                Ultimately, our vision is to turn every Lookbayan journey into a <strong>meaningful cultural encounter</strong> one that leaves a lasting impact on both the traveler and the destination.
            </p>
        </div>
    </div>

    <section class="meet-the-team">
            <!-- Background Video -->
    <video class="meet-the-team-bg-video" autoplay loop muted>
        <source src="arch.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Overlay to darken the video background -->
    <div class="about-bg-overlay"></div>
        <div class="container">
            <div class="section-title">
                <h2>Meet the Team</h2>
                <p>Our talented and dedicated team is here to make your travel experience unforgettable.</p>
            </div>
            <div class="team-members">
                <div class="team-member">
                    <img src="lester.jpg" alt="Team Member 1" class="team-member-img">
                    <h3>John Lester Magana</h3>
                    <p class="role">Back-End Developer</p>
                </div>
                <div class="team-member">
                    <img src="chan.jpg" alt="Team Member 2" class="team-member-img">
                    <h3>John Christian Maturan</h3>
                    <p class="role">Project Manager</p>
                </div>
                <div class="team-member">
                    <img src="ace.jpg" alt="Team Member 3" class="team-member-img">
                    <h3>Ace Venedic Esguerra</h3>
                    <p class="role">Quality Assurance</p>
                </div>
                <div class="team-member">
                    <img src="cj.jpg" alt="Team Member 4" class="team-member-img">
                    <h3>Chris John Cuanang</h3>
                    <p class="role">Front-End Developer</p>
                </div>
                <div class="team-member">
                    <img src="yobib.jpg" alt="Team Member 5" class="team-member-img">
                    <h3>John Lester Aviso</h3>
                    <p class="role">Documentation</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-logo">
                <img src="<?php echo $logoSrc; ?>" alt="Lakbayan Logo"> 
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