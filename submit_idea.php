<?php
// submit_idea.php

// Database credentials — update these for your setup
$host = 'localhost';
$dbname = 'me-inock';
$user = 'root';
$pass = '';

// Connect to MySQL
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Validate required POST data
if (isset($_POST['visitor_name'], $_POST['idea']) && !empty($_POST['visitor_name']) && !empty($_POST['idea'])) {
    $visitor_name = $_POST['visitor_name'];
    $ig_username = $_POST['ig_username'] ?? '';
    $idea = $_POST['idea'];

    // Prepare statement
    $stmt = $conn->prepare("INSERT INTO ideas (visitor_name, ig_username, idea) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $visitor_name, $ig_username, $idea);

    if ($stmt->execute()) {
        echo "Thank you for your idea!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Please fill in the required fields.";
}

$conn->close();
?>
