<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mots anglais</title>
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
            background-color: #8c05f4; /* Changez en la couleur sélectionnée souhaitée */
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
        /* Bouton de déconnexion */
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
        // Tableau de mots dans un ordre aléatoire
        $words = array(
            "Pomme", "Banane", "Pastèque", "Raisin",
            "Bonjour", "Salut", "Hey", "Comment ça va",
            "Rouge", "Bleu", "Vert", "Jaune",
            "Chien", "Chat", "Oiseau", "Éléphant"
        );
        shuffle($words); // Mélangez le tableau de mots pour les afficher dans un ordre aléatoire
        foreach ($words as $word) {
            echo "<div class='word'>$word</div>";
        }
        ?>
    </div>
    <div class="buttons">
    <button onclick="reshuffle()">Išmaišyti</button>
        <button onclick="showHints()">Užuomena</button>
    </div>
    <!-- Bouton de déconnexion -->
    <button class="logout-btn" onclick="logout()">Atsijungti</button>
</div>

<script>
    // Obtenir tous les éléments de mots
    const words = document.querySelectorAll('.word');
    
    let selectedWords = [];

    // Ajouter un écouteur d'événements de clic à chaque mot
    words.forEach(word => {
        word.addEventListener('click', () => {
            word.classList.toggle('selected');
            if (word.classList.contains('selected')) {
                selectedWords.push(word);
            } else {
                selectedWords = selectedWords.filter(selectedWord => selectedWord !== word);
            }
            if (selectedWords.length === 4) {
                // Vérifiez si tous les mots sélectionnés sont dans la même catégorie
                const firstWordCategory = getCategory(selectedWords[0].textContent);
                const allSameCategory = selectedWords.every(word => getCategory(word.textContent) === firstWordCategory);
                if (allSameCategory) {
                    // Changez la couleur des mots sélectionnés en une couleur aléatoire différente des autres catégories terminées
                    const colorClass = 'category' + firstWordCategory;
                    const color = getRandomColor();
                    selectedWords.forEach(selectedWord => {
                        selectedWord.classList.remove('selected');
                        selectedWord.classList.add(colorClass);
                        selectedWord.style.backgroundColor = color;
                    });
                } else {
                    // Réinitialiser les mots sélectionnés
                    selectedWords.forEach(selectedWord => {
                        selectedWord.classList.remove('selected');
                    });
                }
                // Effacer la sélection
                selectedWords = [];
            }
        });
    });

    // Fonction pour obtenir la catégorie d'un mot (exemple de fonction, remplacez-la par votre logique)
    function getCategory(word) {
        const fruitWords = ["Pomme", "Banane", "Pastèque", "Raisin"];
        const greetingWords = ["Bonjour", "Salut", "Hey", "Comment ça va"];
        const colorWords = ["Rouge", "Bleu", "Vert", "Jaune"];
        const animalWords = ["Chien", "Chat", "Oiseau", "Éléphant"];

        if (fruitWords.includes(word)) return 1;
        if (greetingWords.includes(word)) return 2;
        if (colorWords.includes(word)) return 3;
        if (animalWords.includes(word)) return 4;
        return 0;
    }

    // Fonction pour générer une couleur aléatoire
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    // Fonction de mélange
    function reshuffle() {
        const container = document.querySelector('.container');
        const words = container.querySelectorAll('.word');
        const shuffledWords = Array.from(words).sort(() => Math.random() - 0.5);
        shuffledWords.forEach(word => container.appendChild(word));
    }

    // Fonction d'indices
    function showHints() {
        const categories = {
            1: "Vaisiai",
            2: "Būdai, kaip pasisveikinti",
            3: "Spalvos",
            4: "Gyvunai"
        };

        let hintsText = "Kategorijos :\n";

        Object.keys(categories).forEach(category => {
            hintsText += `${category}: ${categories[category]}\n`;
        });

        // Afficher une fenêtre avec les catégories
        alert(hintsText);
    }

    // Fonction de déconnexion
    function logout() {
        window.location.href = 'logging.php'; // Rediriger vers logging.php
    }
</script>
</body>
</html>
