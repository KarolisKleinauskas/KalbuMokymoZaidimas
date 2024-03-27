<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["username"])) {
    header("Location: logging.php");
    exit();
}

// Logout logic
if (isset($_POST["logout"])) {
    // Unset all session variables
    session_unset();
    // Destroy the session
    session_destroy();
    // Redirect to the login page
    header("Location: logging.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }

        .container {
            position: relative;
            height: 100%;
        }

        .logout {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .logout-form button {
            padding: 10px 20px;
            background-color: #8c05f4;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-form button:hover {
            background-color: #6a02c3;
        }

        .quiz-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .choose-text {
            text-align: center;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .quiz-link {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .quiz-link a {
            text-decoration: none;
            color: #000;
            font-size: 24px;
            margin: 10px;
        }

        .quiz-link img {
            width: 100px;
            height: 100px;
            margin: 10px;
            cursor: pointer;
        }
        
    </style>
</head>
<body>
<div class="container">
    <div class="logout">
        <form method="post" class="logout-form">
            <button type="submit" name="logout">Atsijungti</button>
        </form>
    </div>
    <div class="quiz-container">
        <div class="choose-text">Pasirinkt kalbą</div>
        <div class='pasirinkimas'>
   
        </div>
        <!-- Replace your quiz link section in index.php with the following code -->
        <div class="quiz-link">
    <a href="english.php">
        <img src="./photos/english.jpeg" alt="English">
    </a>
    <a href="german.php">
        <img src="./photos/germany.png" alt="German">
    </a>
    <a href="spanish.php">
        <img src="./photos/spanish.jpeg" alt="Spanish">
    </a>
    <a href="france.php">
        <img src="./photos/france.png" alt="French">
    </a>
</div>

    </div>
</div>
</body>
</html>
