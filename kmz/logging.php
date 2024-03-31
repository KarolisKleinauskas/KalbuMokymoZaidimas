<?php
session_start();

// Initialize error message
$error = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare SQL statement to fetch user from database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User found, verify password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            // Password is correct, set session variables
            $_SESSION["username"] = $user["username"];
            // Redirect to dashboard or any other authenticated page
            header("Location: index.php");
            exit(); // Stop executing further code
        } else {
            // Password is incorrect
            $error = "Neteisingas vartotojo vardas arba slaptažodis.";
        }
    } else {
        // User not found
        $error = "Neteisingas vartotojo vardas arba slaptažodis.";
    }

    $stmt->close();
    $conn->close(); // Close database connection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            height: 100%;
        }

        .image-container {
            flex: 1;
            background-image: url("https://static.vecteezy.com/system/resources/previews/024/231/585/non_2x/cartoon-color-planning-board-concept-vector.jpg");
            background-size: cover;
            background-position: center;
        }

        .form-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .login-form {
            max-width: 300px;
            width: 100%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-form input[type="text"],
        .login-form input[type="password"],
        .login-form button {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .login-form button {
            background-color: #8c05f4;
            color: #fff;
            cursor: pointer;
        }

        .login-form button:hover {
            background-color: #8c05f4;
        }

        .spykeris {
            color: purple;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="image-container"></div>
    <div class="form-container">
        <h2>
            Sveiki atvyktę į kalbų mokymo žaidima
            <span class="spykeris">Spykeris</span>
        </h2>
        <form class="login-form" id="loginForm" method="post" action="">
            <h2>Prisijungimas</h2>
            <input
                type="text"
                id="username"
                name="username"
                placeholder="Vartotojo vardas"
                required
            />
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Slaptažodis"
                required
            />
            <button type="submit">Prisijungti</button>
            <div class="error-message"><?php if(isset($error)) echo $error; ?></div>
            <div style="text-align: center">
                <a href="register.php">Jei neturite paskyros- spauskite čia</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
