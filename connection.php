<?php
// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$database = "kmz";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "Slaptažodžiai nesutampa!";
        exit;
    }

    // Hash the password (for security)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute SQL statement to insert data into the table
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashedPassword);

    if ($stmt->execute()) {
        echo "Registracija sėkminga!";
    } else {
        echo "Klaida registruojant vartotoją: " . $stmt->error;
    }

    $stmt->close();
}

// Close database connection
$conn->close();
?>
