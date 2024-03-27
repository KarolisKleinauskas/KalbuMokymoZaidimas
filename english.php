<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>English Words</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .wrapper {
            text-align: center;
        }
        .container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 10px;
            padding: 20px;
        }
        .word {
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
            cursor: pointer;
        }
        .selected {
            background-color: #8c05f4; /* Change to your desired selected color */
            color: #fff;
        }
        .category1 {
            color: #fff;
        }
        .category2 {
            color: #fff;
        }
        .category3 {
            color: #fff;
        }
        .category4 {
            color: #fff;
        }
        .buttons {
            margin-top: 20px;
        }
        .buttons button {
            padding: 10px 20px;
            margin: 0 10px;
            cursor: pointer;
        }
        /* Logout button */
        .logout-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px 10px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container">
        <?php
        // Array of words in random order
        $words = array(
            "Apple", "Banana", "Watermelon", "Grapes",
            "Hello", "Hi", "Hey", "Howdy",
            "Red", "Blue", "Green", "Yellow",
            "Dog", "Cat", "Bird", "Elephant"
        );
        shuffle($words); // Shuffle the words array to display in random order
        foreach ($words as $word) {
            echo "<div class='word'>$word</div>";
        }
        ?>
    </div>
    <div class="buttons">
        <button onclick="reshuffle()">Išmaišyti</button>
        <button onclick="showHints()">Užuomena</button>
    </div>
    <!-- Logout button -->
    <button class="logout-btn" onclick="logout()">Atsijungti</button>
</div>

<script>
    // Get all word elements
    const words = document.querySelectorAll('.word');
    
    let selectedWords = [];

    // Add click event listener to each word
    words.forEach(word => {
        word.addEventListener('click', () => {
            word.classList.toggle('selected');
            if (word.classList.contains('selected')) {
                selectedWords.push(word);
            } else {
                selectedWords = selectedWords.filter(selectedWord => selectedWord !== word);
            }
            if (selectedWords.length === 4) {
                // Check if all selected words are in the same category
                const firstWordCategory = getCategory(selectedWords[0].textContent);
                const allSameCategory = selectedWords.every(word => getCategory(word.textContent) === firstWordCategory);
                if (allSameCategory) {
                    // Change color of selected words to a random color different from other completed categories
                    const colorClass = 'category' + firstWordCategory;
                    const color = getRandomColor();
                    selectedWords.forEach(selectedWord => {
                        selectedWord.classList.remove('selected');
                        selectedWord.classList.add(colorClass);
                        selectedWord.style.backgroundColor = color;
                    });
                } else {
                    // Reset selected words
                    selectedWords.forEach(selectedWord => {
                        selectedWord.classList.remove('selected');
                    });
                }
                // Clear selection
                selectedWords = [];
            }
        });
    });

    // Function to get the category of a word (example function, replace with your logic)
    function getCategory(word) {
        const fruitWords = ["Apple", "Banana", "Watermelon", "Grapes"];
        const greetingWords = ["Hello", "Hi", "Hey", "Howdy"];
        const colorWords = ["Red", "Blue", "Green", "Yellow"];
        const animalWords = ["Dog", "Cat", "Bird", "Elephant"];

        if (fruitWords.includes(word)) return 1;
        if (greetingWords.includes(word)) return 2;
        if (colorWords.includes(word)) return 3;
        if (animalWords.includes(word)) return 4;
        return 0;
    }

    // Function to generate a random color
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    // Reshuffle function
    function reshuffle() {
        const container = document.querySelector('.container');
        const words = container.querySelectorAll('.word');
        const shuffledWords = Array.from(words).sort(() => Math.random() - 0.5);
        shuffledWords.forEach(word => container.appendChild(word));
    }

    // Hints function
function showHints() {
    const categories = {
        1: "Vaisiai",
        2: "Būdai, kaip pasisveikinti",
        3: "Spalvos",
        4: "Gyvunai"
    };

    let hintsText = "Kategorijos:\n";

    Object.keys(categories).forEach(category => {
        hintsText += `${category}: ${categories[category]}\n`;
    });

    // Display a window with the categories
    alert(hintsText);
}
function logout() {
        window.location.href = 'logging.php'; // Redirect to logging.php
    }
</script>

</body>
</html>
