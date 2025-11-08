<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "travel_booking"; // Replace with your actual DB name

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form inputs
$title = $_POST['tourTitle'];
$desc = $_POST['tourDesc'];
$price = $_POST['tourPrice'];

// Handle image upload
$image = $_FILES['tourImage'];
$imageName = basename($image["name"]);
$targetDir = "uploads/"; // Make sure this folder exists and is writable
$targetFile = $targetDir . time() . "_" . $imageName;

if (move_uploaded_file($image["tmp_name"], $targetFile)) {
    // Save to database
    $stmt = $conn->prepare("INSERT INTO destinations (destination_name, description, price, image_url) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $title, $desc, $price, $targetFile);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "error: Failed to upload image.";
}

$conn->close();
?>
