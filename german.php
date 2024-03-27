<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Englische Wörter</title>
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
            background-color: #8c05f4; /* Ändern Sie die gewünschte ausgewählte Farbe */
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
        /* Logout-Schaltfläche */
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
        // Array der Wörter in zufälliger Reihenfolge
        $words = array(
            "Apfel", "Banane", "Wassermelone", "Trauben",
            "Hallo", "Hi", "Hey", "Wie geht's",
            "Rot", "Blau", "Grün", "Gelb",
            "Hund", "Katze", "Vogel", "Elefant"
        );
        shuffle($words); // Mischen Sie das Array der Wörter, um sie in zufälliger Reihenfolge anzuzeigen
        foreach ($words as $word) {
            echo "<div class='word'>$word</div>";
        }
        ?>
    </div>
    <div class="buttons">
    <button onclick="reshuffle()">Išmaišyti</button>
        <button onclick="showHints()">Užuomena</button>
    </div>
    <!-- Logout-Schaltfläche -->
    <button class="logout-btn" onclick="logout()">Atsijungti</button>
</div>

<script>
    // Holen Sie alle Wortelemente
    const words = document.querySelectorAll('.word');
    
    let selectedWords = [];

    // Fügen Sie jedem Wort einen Klick-Ereignislistener hinzu
    words.forEach(word => {
        word.addEventListener('click', () => {
            word.classList.toggle('selected');
            if (word.classList.contains('selected')) {
                selectedWords.push(word);
            } else {
                selectedWords = selectedWords.filter(selectedWord => selectedWord !== word);
            }
            if (selectedWords.length === 4) {
                // Überprüfen Sie, ob alle ausgewählten Wörter in derselben Kategorie sind
                const firstWordCategory = getCategory(selectedWords[0].textContent);
                const allSameCategory = selectedWords.every(word => getCategory(word.textContent) === firstWordCategory);
                if (allSameCategory) {
                    // Ändern Sie die Farbe der ausgewählten Wörter in eine zufällige Farbe, die sich von anderen abgeschlossenen Kategorien unterscheidet
                    const colorClass = 'category' + firstWordCategory;
                    const color = getRandomColor();
                    selectedWords.forEach(selectedWord => {
                        selectedWord.classList.remove('selected');
                        selectedWord.classList.add(colorClass);
                        selectedWord.style.backgroundColor = color;
                    });
                } else {
                    // Zurücksetzen der ausgewählten Wörter
                    selectedWords.forEach(selectedWord => {
                        selectedWord.classList.remove('selected');
                    });
                }
                // Auswahl leeren
                selectedWords = [];
            }
        });
    });

    // Funktion zum Abrufen der Kategorie eines Wortes (Beispiel für eine Funktion, ersetzen Sie sie durch Ihre Logik)
    function getCategory(word) {
        const fruitWords = ["Apfel", "Banane", "Wassermelone", "Trauben"];
        const greetingWords = ["Hallo", "Hi", "Hey", "Wie geht's"];
        const colorWords = ["Rot", "Blau", "Grün", "Gelb"];
        const animalWords = ["Hund", "Katze", "Vogel", "Elefant"];

        if (fruitWords.includes(word)) return 1;
        if (greetingWords.includes(word)) return 2;
        if (colorWords.includes(word)) return 3;
        if (animalWords.includes(word)) return 4;
        return 0;
    }

    // Funktion zum Generieren einer zufälligen Farbe
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    // Mischen Funktion
    function reshuffle() {
        const container = document.querySelector('.container');
        const words = container.querySelectorAll('.word');
        const shuffledWords = Array.from(words).sort(() => Math.random() - 0.5);
        shuffledWords.forEach(word => container.appendChild(word));
    }

    // Hinweis Funktion
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

        // Zeigen Sie ein Fenster mit den Kategorien an
        alert(hintsText);
    }

    // Logout Funktion
    function logout() {
        window.location.href = 'logging.php'; // Weiterleitung zu logging.php
    }
</script>

</body>
</html>
