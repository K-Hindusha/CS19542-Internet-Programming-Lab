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

// Collecting user input
$username = $conn->real_escape_string($_POST['username']);
$password = $conn->real_escape_string($_POST['password']);

// Prepare and bind
$stmt = $conn->prepare("SELECT password, user_type FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($hashed_password, $user_type);

if ($stmt->num_rows > 0) {
    $stmt->fetch();
    // Verify the password
    if (password_verify($password, $hashed_password)) {
        echo "Login successful!";
        // Here you can start a session and redirect to a protected page
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = $user_type;
        header("Location: ../index.html"); // Redirect to homepage after successful login
    } else {
        echo "Invalid password!";
    }
} else {
    echo "No user found with that username!";
}

// Close connections
$stmt->close();
$conn->close();
?>
