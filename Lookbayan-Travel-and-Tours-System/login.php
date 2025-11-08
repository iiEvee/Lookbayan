<?php
include 'session.php';
include 'db_connect.php'; // your DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['login_email'];
    $password = $_POST['login_password'];

    // Save email to session in case of error
    $_SESSION['login_email_temp'] = $email;

    // Query to find user by email
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($fetched_user = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $fetched_user['password'])) {
            // ✅ Set session variables
            $_SESSION['user_name'] = $fetched_user['name'];
            $_SESSION['user_id'] = $fetched_user['user_id']; // ✅ use 'id' instead of 'user_id'
            $_SESSION['user_image'] = $fetched_user['user_image']; // Assuming your table has this column
            
            echo "<pre>";
            print_r($_SESSION);  // Debug: Check if user_id is being set correctly
            echo "</pre>";

            // Clear the temp email
            unset($_SESSION['login_email_temp']);

            header("Location: destinations.php");
            exit();
        } else {
            echo "<script>alert('Incorrect password. Please try again.'); window.location.href='logsig.php';</script>";
        }
    } else {
        echo "<script>alert('No user found with that email.'); window.location.href='logsig.php';</script>";
    }
}
?>