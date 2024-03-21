<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["username"])) {
    header("Location: logging.php");
    exit();
}

// Define arrays of words and corresponding images for each language
$englishWords = array("Tree", "Table", "Chair", "Grass");
$germanWords = array("Baum", "Tisch", "Stuhl", "Gras");
$spanishWords = array("árbol", "mesa", "silla", "césped");
$frenchWords = array("arbre", "table", "chaise", "herbe");

// Get the selected language from the URL parameter
$lang = $_GET['lang'];

// Determine the words and images based on the selected language
if ($lang == 'english') {
    $words = $englishWords;
    $language = "English";
} elseif ($lang == 'german') {
    $words = $germanWords;
    $language = "German";
} elseif ($lang == 'spanish') {
    $words = $spanishWords;
    $language = "Spanish";
} elseif ($lang == 'french') {
    $words = $frenchWords;
    $language = "French";
} else {
    // Default to English if no valid language is selected
    $words = $englishWords;
    $language = "English";
}

// Get a random word and its corresponding image
$randomIndex = array_rand($words);
$randomWord = $words[$randomIndex];
$imageUrl = "./photos/" . strtolower($randomWord) . ".jpg"; // Adjusted path to the images

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
    <title>Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            text-align: center;
            margin-top: 50px;
            position: relative; /* Make the container relative for absolute positioning */
        }

        .logout {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 999; /* Ensure it's above other content */
        }

        .word-image {
            margin-bottom: 20px;
        }

        .word-image img {
            width: 300px; /* Adjust the width to your preference */
            height: auto; /* Maintain aspect ratio */
        }

        .word-buttons {
            display: grid;
            grid-template-columns: repeat(2, auto); /* Two columns with auto width */
            gap: 20px; /* Gap between buttons */
            justify-content: center; /* Center horizontally */
        }

        .word-button, .logout button {
            margin: 10px;
            padding: 10px 20px; /* Adjusted padding for smaller buttons */
            background-color: #8c05f4;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 20px; /* Adjusted font size for smaller buttons */
        }
    </style>
</head>
<body>
<div class="container">
    <div class="logout">
        <form method="post">
            <button type="submit" name="logout" class="word-button">Logout</button>
        </form>
    </div>
    <div class="word-image">
        <img src="<?php echo $imageUrl; ?>" alt="<?php echo $randomWord; ?>">
    </div>
    <div class="word-buttons">
        <?php
        // Shuffle the words to display them in random order
        shuffle($words);
        foreach ($words as $word) {
            echo "<button class='word-button'>$word</button>";
        }
        ?>
    </div>
</div>
</body>
</html>
