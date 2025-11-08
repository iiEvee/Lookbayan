<?php
include 'session.php';
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = intval($_POST['user_id']);
    $destination_id = intval($_POST['destination_id']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $pax = intval($_POST['pax']);
    $full_name = $conn->real_escape_string(trim($_POST['full_name']));
    $mobile = $conn->real_escape_string(trim($_POST['mobile']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $comments = $conn->real_escape_string(trim($_POST['comments']));

    // Choose to store start_date or a formatted range — let's store start_date for simplicity
    $booking_date = $start_date;

    // Insert into bookings table
    $query = "INSERT INTO bookings (
        user_id, destination_id, booking_date, start_date, end_date, comments, status, pax, full_name, mobile, email
    ) VALUES (
        '$user_id', '$destination_id', '$booking_date', '$start_date', '$end_date', '$comments', 'pending', '$pax', '$full_name', '$mobile', '$email'
    )";

    if (mysqli_query($conn, $query)) {
        header("Location: confirmation.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>