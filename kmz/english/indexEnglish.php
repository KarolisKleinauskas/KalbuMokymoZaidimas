<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>English Words</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
            background-color: #8c05f4;
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
        .back-btn {
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 5px 10px;
            background-color: #337ab7;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-btn:hover {
            background-color: #286090;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <a href="../index.php" class="back-btn">Grįžti atgal</a>
    <div class="container">
        <?php
        require_once 'controllerEnglish.php';
        $controller = new WordController();
        $controller->displayWords();
        ?>
    </div>
    <div class="buttons">
        <button onclick="reshuffle()">Išmaišyti</button>
        <button class="btn btn-primary" onclick="showHints()">Užuomina</button>
    </div>
    <button class="logout-btn" onclick="logout()">Atsijungti</button>
</div>
<!-- Modal -->
<div class="modal fade" id="hintsModal" tabindex="-1" role="dialog" aria-labelledby="hintsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hintsModalLabel">Užuominos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="hintsText">
                <!-- Čia bus rodomos užuomenos -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti</button>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    const words = document.querySelectorAll('.word');

    let selectedWords = [];

    words.forEach(word => {
        word.addEventListener('click', () => {
            word.classList.toggle('selected');
            if (word.classList.contains('selected')) {
                selectedWords.push(word);
            } else {
                selectedWords = selectedWords.filter(selectedWord => selectedWord !== word);
            }
            if (selectedWords.length === 4) {
                const firstWordCategory = getCategory(selectedWords[0].textContent);
                const allSameCategory = selectedWords.every(word => getCategory(word.textContent) === firstWordCategory);
                if (allSameCategory) {
                    const colorClass = 'category' + firstWordCategory;
                    const color = getRandomColor();
                    selectedWords.forEach(selectedWord => {
                        selectedWord.classList.remove('selected');
                        selectedWord.classList.add(colorClass);
                        selectedWord.style.backgroundColor = color;
                    });
                } else {
                    selectedWords.forEach(selectedWord => {
                        selectedWord.classList.remove('selected');
                    });
                }
                selectedWords = [];
            }
        });
    });

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

    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    function reshuffle() {
        const container = document.querySelector('.container');
        const words = container.querySelectorAll('.word');
        const shuffledWords = Array.from(words).sort(() => Math.random() - 0.5);
        shuffledWords.forEach(word => container.appendChild(word));
    }

    function showHints() {
        const categories = {
            1: "Vaisiai",
            2: "Būdai, kaip pasisveikinti",
            3: "Spalvos",
            4: "Gyvūnai"
        };

        let hintsText = "<h3>Kategorijos:</h3><ul>";

        Object.keys(categories).forEach(category => {
            hintsText += `<li><strong>${categories[category]}</strong>: ${category}</li>`;
        });

        hintsText += "</ul>";

        const hintsContent = document.getElementById('hintsText');
        hintsContent.innerHTML = hintsText;

        // Rodo modalį
        $('#hintsModal').modal('show');
    }

    function logout() {
        window.location.href = 'logging.php';
    }
</script>
</body>
</html>
