<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "kmz";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    if ($password !== $confirmPassword) {
        echo "Slaptažodžiai nesutampa!";
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashedPassword);

    if ($stmt->execute()) {
        echo "Registracija sėkminga!";
    } else {
        echo "Klaida registruojant vartotoją: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
