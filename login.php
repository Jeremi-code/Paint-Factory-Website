<?php
session_start();

$username= $_POST['username'];
$password = $_POST['password'];

// Connect to the database
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "users";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Couldn't connect to the database: " . $conn->connect_error);
} 

// Validate the user's credentials
$stmt = $conn->prepare("SELECT * FROM customers WHERE username = ? AND password1= ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {

    // Login successful
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    //header("location: blog.php");
    echo "You are sucessfully authenticated";
    exit;
} 
else {
    // Login failed
    echo "Invalid username or password.";
}
$conn->close();
?>