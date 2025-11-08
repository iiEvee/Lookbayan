<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'session.php';
include 'db_connect.php';

// ✅ Fetch destinations
$sql = "SELECT * FROM destinations";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Destinations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="destinations.css">
    <link rel="shortcut icon" href="logoo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="nav-logo">
        <img src="logoo.png" alt="Lakbayan Logo">
        <span>Lookbayan</span>
    </div>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="destinations.php" class="active">Destinations</a></li>
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
                <img src="<?= $user_image ?>" class="profile-pic" alt="User">
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

<!-- Hero -->
<section class="destinations">
    <video autoplay loop muted playsinline>
        <source src="travel.mp4" type="video/mp4">
    </video>
    <div class="overlay"></div>
    <div class="destinations-content">
        <h2>DESTINATIONS</h2>
        <p>Here are some of the featured destinations included in the packages</p>
    </div>
</section>

<!-- Dynamic Destinations -->
<div class="destinations-container">
<?php
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $destinationName = htmlspecialchars($row["destination_name"], ENT_QUOTES);
        $description = htmlspecialchars($row["description"], ENT_QUOTES);
        $itinerary = htmlspecialchars($row["itinerary"], ENT_QUOTES);
        $destinationId = (int)$row["destination_id"];
        $imageUrl = htmlspecialchars($row["image_url"]);

        echo '<div class="destination" onclick="showDetails(`' . $destinationName . '`, `' . $description . '`, `' . $itinerary . '`, ' . $destinationId . ', `' . $imageUrl . '`)">';
        echo '<img src="' . $imageUrl . '" alt="' . $destinationName . '">';
        echo '<span>' . $destinationName . '</span>';
        echo '</div>';
    }    
} else {
    echo "<p>No destinations available.</p>";
}
?>
</div>

<!-- 🆕 Updated Destination Info Modal -->
<div id="destinationModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('destinationModal')">&times;</span>

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="index.php">Home</a>
            <span>&gt;</span>
            <a href="destinations.php">Destinations</a>
            <span>&gt;</span>
            <span id="breadcrumbDestination"></span>
        </div>

        <!-- Tour Main Info -->
        <div class="tour-details">
            <div class="tour-image">
            <div class="tour-image">
    <img id="modalImage" src="" alt="Destination Image" style="display: block; width: 100%; border-radius: 10px;">
    <iframe id="modalIframe" src="" style="display: none; width: 100%; height: 300px; border-radius: 10px;" allowfullscreen></iframe>
</div>
<div style="margin-top: 10px;">
    <button onclick="showVirtualTour()">View Virtual Tour</button>
    <button onclick="showImage()">View Image</button>
</div>

            </div>
            <div class="tour-info">
                <h1 id="modalTitle"></h1>
                <div class="meta"><i class="fas fa-calendar-alt"></i> 4 Days & 3 Nights</div>
                <div class="meta"><i class="fas fa-map-marker-alt"></i> Philippines</div>
                <p id="modalDescription"></p>
                <p><strong>Explore the beauty of this destination with our exclusive travel package!</strong></p>
                <button class="btns" onclick="openBooking()">Book Now</button>
            </div>
        </div>

        <!-- Tour Tabs -->
        <div class="tour-tabs">
            <div class="tab-header">
                <div onclick="openTab(event, 'itinerary')" class="tab-button btn active"><i class="fas fa-map-pin"></i> Itinerary</div>
                <div onclick="openTab(event, 'inclusions')" class="tab-button btn"><i class="fas fa-gift"></i> Inclusions</div>
                <div onclick="openTab(event, 'optional')" class="tab-button btn"><i class="fas fa-box"></i> Optional</div>
            </div>
            <div id="itinerary" class="tab-content active">
                <p id="modalHighlights">Island hopping experience, visit to local attractions...</p>
            </div>
            <div id="inclusions" class="tab-content">
                <p id="modalItinerary">Includes airline ticket, hotel stay, breakfast...</p>
            </div>
            <div id="optional" class="tab-content">
                <p id="modalOptional">Add-ons: Firefly watching, zipline, etc.</p>
            </div>
        </div>
    </div>
</div>

<!-- Booking Modal -->
<div id="bookingModal" class="modal">
    <div class="modal-content booking-style">
        <span class="close" onclick="closeModal('bookingModal')">&times;</span>
        <h3>Tour Packages</h3>
        
        <!-- Destination Info Card -->
        <div class="booking-destination-card">
            <img id="bookingImage" src="" alt="Destination Image">
            <div>
                <div class="booking-meta">4 Days & 3 Nights</div>
                <h4 id="destinationName"></h4>
                <div class="booking-location"><i class="fas fa-map-marker-alt"></i> Philippines</div>
            </div>
        </div>

<!-- Booking Form -->
<form id="bookingForm" action="book_destination.php" method="POST" class="booking-form">
    <input type="hidden" id="destinationId" name="destination_id">
    <input type="hidden" id="userId" name="user_id" value="<?php echo $_SESSION['user_id'] ?? ''; ?>">

    <div class="containers">
        <h2>Choose Travel Agency</h2>
        <select id="agencySelect" onchange="displayTours()">
            <option value="">-- Select Travel Agency --</option>
            <option value="wanderlust">Wanderlust Travels</option>
            <option value="adventureCo">Adventure Co.</option>
            <option value="beachlife">Beach Life Tours</option>
        </select>
    </div>

    <div class="booking-dates">
        <label>Preferred Travel Date</label>
        <label>Start</label>
        <input type="date" name="start_date" id="start_date" required min="<?= date('Y-m-d') ?>">
        <label>End</label>
        <input type="date" name="end_date" id="end_date" required min="<?= date('Y-m-d') ?>">
    </div>

    <div class="booking-group">
        <label for="pax">Pax</label>
        <input type="number" name="pax" min="1" required>
    </div>

    <h3>Guest Names:</h3>
    <div id="guestNamesContainer">
      <input type="text" name="guestName[]" placeholder="Enter guest name" required>
    </div>
    <button type="button" onclick="addGuestName()">Add Another Guest</button><br><br>

    <div class="booking-group">
        <label for="full_name">Full Name</label>
        <input type="text" name="full_name" placeholder="Your full name" required>
    </div>

    <div class="booking-group-row">
        <div class="booking-group">
            <label for="mobile">Mobile Number</label>
            <input type="text" name="mobile" placeholder="(+63 917 456 7890)" required>
        </div>
        <div class="booking-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" placeholder="Your email address" required>
        </div>
    </div>

    <div class="booking-group">
        <label for="comments">Additional Details</label>
        <textarea name="comments" placeholder="Tell us more about your inquiry."></textarea>
    </div>

    <!-- Payment Method -->
    <h2>Payment Information</h2>
    <div class="booking-group">
        <label for="payment_method">Payment Method</label>
        <select id="payment_method" name="payment_method" required onchange="togglePaymentFields()">
            <option value="">-- Select Payment Method --</option>
            <option value="card">Credit/Debit Card</option>
            <option value="gcash">GCash</option>
        </select>
    </div>

    <!-- Card Payment Fields -->
    <div id="cardFields" style="display: none;">
        <div class="booking-group">
            <label for="card_name">Cardholder Name</label>
            <input type="text" id="card_name" name="card_name" placeholder="Name on card">
        </div>

        <div class="booking-group">
            <label for="card_number">Card Number</label>
            <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" maxlength="19" pattern="\d{16,19}">
        </div>

        <div class="booking-group-row">
            <div class="booking-group">
                <label for="expiry_date">Expiry Date</label>
                <input type="month" id="expiry_date" name="expiry_date">
            </div>
            <div class="booking-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" maxlength="4" pattern="\d{3,4}">
            </div>
        </div>
    </div>

    <!-- GCash Payment Field -->
    <div id="gcashField" style="display: none;">
        <div class="booking-group">
            <label for="gcash_number">GCash Number</label>
            <input type="text" id="gcash_number" name="gcash_number" placeholder="09xxxxxxxxx">
        </div>
    </div>

    <!-- Confirm Button -->
    <button class="confirm-booking-btn btn" type="submit">
        Confirm Booking <i class="fas fa-paper-plane"></i>
    </button>
</form>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="footer-container">
        <div class="footer-logo">
            <img src="logoo.png" alt="Lakbayan Logo"> 
        </div>
        <div class="footer-about">
            <h3>About</h3>
            <p>Lookbayan Travel and Tours provides a convenient and premium travel and tour service for local destinations in the Philippines.</p>
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
  const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
</script>

<!-- Scripts -->
<script>
function addGuestName() {
  const container = document.getElementById('guestNamesContainer');
  const input = document.createElement('input');
  input.type = 'text';
  input.name = 'guestName[]';
  input.placeholder = 'Enter guest name';
  input.required = true;
  container.appendChild(input);
}

function togglePaymentFields() {
    const method = document.getElementById("payment_method").value;
    const cardFields = document.getElementById("cardFields");
    const gcashField = document.getElementById("gcashField");

    // Card input fields
    const cardInputs = ["card_name", "card_number", "expiry_date", "cvv"];
    const gcashInput = document.getElementById("gcash_number");

    if (method === "card") {
        cardFields.style.display = "block";
        gcashField.style.display = "none";
        cardInputs.forEach(id => document.getElementById(id).required = true);
        gcashInput.required = false;
    } else if (method === "gcash") {
        gcashField.style.display = "block";
        cardFields.style.display = "none";
        cardInputs.forEach(id => document.getElementById(id).required = false);
        gcashInput.required = true;
    } else {
        cardFields.style.display = "none";
        gcashField.style.display = "none";
        cardInputs.forEach(id => document.getElementById(id).required = false);
        gcashInput.required = false;
    }
}

let currentDestinationId = null;
let currentDestinationName = '';

function showDetails(title, description, itinerary, destinationId, imageUrl) {
    // Set modal content
    document.getElementById('modalTitle').innerText = title;
    document.getElementById('modalDescription').innerText = description;
    document.getElementById('modalItinerary').innerText = itinerary;
    document.getElementById('modalImage').src = imageUrl;
    document.getElementById('breadcrumbDestination').innerText = title;

    // Define the virtual tour URL (where the virtual tour page is located)
    const virtualTourUrl = "http://localhost/Lookbayan-Travel-and-Tours-System/Over_Cavite/index.html";

    // Set the iframe source to the virtual tour URL
    document.getElementById('modalIframe').src = virtualTourUrl;

    // Store the destination data
    currentDestinationId = destinationId;
    currentDestinationName = title;
    currentDestinationImage = imageUrl;

    // Show the modal
    const modal = document.getElementById('destinationModal');
    modal.style.display = 'flex'; // show with flex to center
    document.body.classList.add('modal-open');
}


function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.style.display = 'none';

    // Check if any modal is still visible
    const modals = document.querySelectorAll('.modal');
    const anyOpen = Array.from(modals).some(m => m.style.display === 'flex' || m.style.display === 'block');

    if (!anyOpen) {
        document.body.classList.remove('modal-open');
    }
}

// ✅ Close modal when clicking outside modal-content
window.addEventListener('click', function(event) {
    const modal = document.getElementById('destinationModal');
    if (event.target === modal) {
        closeModal('destinationModal');
    }

    const bookingModal = document.getElementById('bookingModal');
    if (event.target === bookingModal) {
        closeModal('bookingModal');
    }
});

function openBooking() {
    if (!isLoggedIn) {
        document.getElementById("loginRequiredModal").style.display = "block";
        return;
    }

    // ✅ Show booking modal
    document.getElementById('destinationModal').style.display = 'none';
    document.getElementById('bookingModal').style.display = 'block';

    document.getElementById('destinationName').innerText = currentDestinationName;
    document.getElementById('destinationId').value = currentDestinationId;
    document.getElementById('bookingImage').src = currentDestinationImage;
}

function closeLoginModal() {
    document.getElementById('loginRequiredModal').style.display = 'none';
}

function redirectToLogin() {
    window.location.href = 'logsig.php';
}

function openTab(evt, tabName) {
    var i, tabcontent, tabbuttons;
    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].classList.remove("active");
    }
    tabbuttons = document.getElementsByClassName("tab-button");
    for (i = 0; i < tabbuttons.length; i++) {
        tabbuttons[i].classList.remove("active");
    }
    document.getElementById(tabName).classList.add("active");
    evt.currentTarget.classList.add("active");
}

// Add this when opening the modal
document.body.style.overflow = 'hidden';
// And this when closing it
document.body.style.overflow = '';

document.getElementById('start_date').addEventListener('change', function () {
        const startDate = this.value;
        const endDateInput = document.getElementById('end_date');
        endDateInput.min = startDate;

        // Optional: Reset end date if it's before new start date
        if (endDateInput.value < startDate) {
            endDateInput.value = startDate;
        }
    });

</script>

<!-- Login Required Modal -->
<div id="loginRequiredModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeLoginModal()">&times;</span>
        <h2>Login Required</h2>
        <p>You need to log in first to book a destination!</p>
        <div class="modal-buttons">
            <button class="btn" onclick="redirectToLogin()">Login Now!</button>
            <button class="btn" onclick="closeLoginModal()">Cancel</button>
        </div>
    </div>
</div>

</body>

<script>
function showVirtualTour() {
    document.getElementById("modalImage").style.display = "none";
    document.getElementById("modalIframe").style.display = "block";
}

function showImage() {
    document.getElementById("modalIframe").style.display = "none";
    document.getElementById("modalImage").style.display = "block";
}
</script>

</html>