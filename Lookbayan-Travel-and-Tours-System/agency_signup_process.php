<?php
// agency_signup_process.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // You can process or validate the form data here if necessary
    
    // Redirect to subscription.php after successful form submission
    header("Location: subscription.php");
    exit; // Prevent further code execution after redirect
}
?>
