<?php
// Configuration
$servername = "localhost";
$username = "root"; // Ganti dengan username MySQL Anda
$password = "";     // Ganti dengan password MySQL Anda
$dbname = "raisya";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare and bind
$stmt = $conn->prepare("SELECT email, password FROM login WHERE email = ?");
$stmt->bind_param("s", $email);

// Execute and get result
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Verify password (no hashing in this case)
    if ($password === $row['password']) {
        header ("Location: index.php");
        // Redirect to a protected page or dashboard
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No user found with that email.";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
