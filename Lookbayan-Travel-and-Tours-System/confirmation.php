<?php
include 'session.php';
require_once 'db_connect.php';

$user_id = $_SESSION['user_id'] ?? null;

if ($user_id) {
    // Fetch user details
    $user_query = "SELECT name AS user_name, email FROM users WHERE user_id = '$user_id'";
    $user_result = mysqli_query($conn, $user_query);

    if (!$user_result) {
        die("User query failed: " . mysqli_error($conn));
    }

    $user_data = mysqli_fetch_assoc($user_result);
    $user_name = $user_data['user_name'];
    $user_email = $user_data['email'];

    // Fetch the latest booking details
    $booking_query = "SELECT destinations.destination_name, bookings.booking_date, bookings.comments, bookings.start_date, bookings.end_date, bookings.pax 
                      FROM bookings 
                      JOIN destinations ON bookings.destination_id = destinations.destination_id 
                      WHERE bookings.user_id = '$user_id' 
                      ORDER BY bookings.booking_id DESC LIMIT 1";
    $booking_result = mysqli_query($conn, $booking_query);

    if (!$booking_result) {
        die("Booking query failed: " . mysqli_error($conn));
    }

    $booking_data = mysqli_fetch_assoc($booking_result);
    $destination_name = $booking_data['destination_name'] ?? 'Unknown';
    $booking_date = $booking_data['booking_date'] ?? 'N/A';
    $comments = $booking_data['comments'] ?? '';
    $start_date = $booking_data['start_date'] ? $booking_data['start_date'] : 'N/A';
    $end_date = $booking_data['end_date'] ? $booking_data['end_date'] : 'N/A';       
    $pax = $booking_data['pax'] ?? 'N/A';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 36px;
            text-align: center;
            color: #5cb85c;
        }
        p {
            font-size: 18px;
            text-align: center;
            line-height: 1.6;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        ul li {
            font-size: 18px;
            margin: 10px 0;
        }
        .confirmation-details {
            margin-top: 20px;
            padding: 20px;
            background-color: #e9f7ef;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .confirmation-details strong {
            color: #5cb85c;
        }
        .button {
            display: block;
            width: 200px;
            margin: 30px auto;
            padding: 10px;
            background-color: #5cb85c;
            color: white;
            text-align: center;
            font-size: 18px;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Booking Confirmed!</h1>
        <p>Hello, <?php echo htmlspecialchars($user_name); ?>!</p>
        <p>Your booking has been successfully placed. Here are your booking details:</p>

        <div class="confirmation-details">
            <ul>
                <li><strong>Destination:</strong> <?php echo htmlspecialchars($destination_name); ?></li>
                <li><strong>Booking Date:</strong> <?php echo htmlspecialchars($booking_date); ?></li>
                <li><strong>Travel Dates:</strong> From <?php echo htmlspecialchars($start_date); ?> to <?php echo htmlspecialchars($end_date); ?></li>
                <li><strong>Number of Passengers:</strong> <?php echo htmlspecialchars($pax); ?></li>
                <li><strong>Comments:</strong> <?php echo htmlspecialchars($comments); ?></li>
            </ul>
        </div>

        <p>You will receive an email at <?php echo htmlspecialchars($user_email); ?> with your booking details shortly. Please check your inbox (and spam folder) for confirmation.</p>

        <a href="index.php" class="button">Back to Home</a>
    </div>

</body>
</html>
