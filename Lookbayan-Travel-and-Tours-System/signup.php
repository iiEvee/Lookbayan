<?php
include 'session.php';
include 'db_connect.php'; // your DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['signup_name'];
    $email = $_POST['signup_email'];
    $password = password_hash($_POST['signup_password'], PASSWORD_DEFAULT);

    // Insert new user
    $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $password);

    if (mysqli_stmt_execute($stmt)) {
        // ✅ Get the last inserted user ID
        $user_id = mysqli_insert_id($conn);

        // ✅ Set session variables
        $_SESSION['user_name'] = $name;
        $_SESSION['user_id'] = $user_id;

        // ✅ Redirect to destinations.php
        header("Location: destinations.php");
        exit();
    } else {
        echo "Signup failed. Try again.";
    }
}
?>