<?php
// Database connection
$servername = "localhost"; // Change as needed
$username = "root"; // Change as needed
$password = ""; // Change as needed
$dbname = "jobportal";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collecting and sanitizing user input
$username = $conn->real_escape_string($_POST['username']);
$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);
$confirm_password = $conn->real_escape_string($_POST['confirm_password']);
$user_type = isset($_POST['check_recruit']) ? 'Recruiter' : 'Jobseeker';

// Basic validation
if ($password !== $confirm_password) {
    die("Passwords do not match!");
}

// Hashing the password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO users (username, email, password, user_type) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $username, $email, $hashed_password, $user_type);

// Execute the statement
if ($stmt->execute()) {
    echo "Registration successful!";
    header("Location: ../index.html"); // Redirect to homepage after successful registration
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
