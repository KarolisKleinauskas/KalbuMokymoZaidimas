<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palabras en inglés</title>
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
            background-color: #8c05f4; /* Cambiar al color seleccionado deseado */
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
        /* Botón de cierre de sesión */
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
        // Array de palabras en orden aleatorio
        $words = array(
            "Manzana", "Plátano", "Sandía", "Uvas",
            "Hola", "Hola", "Hey", "¿Qué tal?",
            "Rojo", "Azul", "Verde", "Amarillo",
            "Perro", "Gato", "Pájaro", "Elefante"
        );
        shuffle($words); // Mezclar el array de palabras para mostrarlas en orden aleatorio
        foreach ($words as $word) {
            echo "<div class='word'>$word</div>";
        }
        ?>
    </div>
    <div class="buttons">
    <button onclick="reshuffle()">Išmaišyti</button>
        <button onclick="showHints()">Užuomena</button>
    </div>
    <!-- Botón de cierre de sesión -->
    <button class="logout-btn" onclick="logout()">Atsijungti</button>
</div>

<script>
    // Obtener todos los elementos de palabras
    const words = document.querySelectorAll('.word');
    
    let selectedWords = [];

    // Agregar un evento de clic a cada palabra
    words.forEach(word => {
        word.addEventListener('click', () => {
            word.classList.toggle('selected');
            if (word.classList.contains('selected')) {
                selectedWords.push(word);
            } else {
                selectedWords = selectedWords.filter(selectedWord => selectedWord !== word);
            }
            if (selectedWords.length === 4) {
                // Comprobar si todas las palabras seleccionadas están en la misma categoría
                const firstWordCategory = getCategory(selectedWords[0].textContent);
                const allSameCategory = selectedWords.every(word => getCategory(word.textContent) === firstWordCategory);
                if (allSameCategory) {
                    // Cambiar el color de las palabras seleccionadas a un color aleatorio diferente de otras categorías completadas
                    const colorClass = 'category' + firstWordCategory;
                    const color = getRandomColor();
                    selectedWords.forEach(selectedWord => {
                        selectedWord.classList.remove('selected');
                        selectedWord.classList.add(colorClass);
                        selectedWord.style.backgroundColor = color;
                    });
                } else {
                    // Restablecer las palabras seleccionadas
                    selectedWords.forEach(selectedWord => {
                        selectedWord.classList.remove('selected');
                    });
                }
                // Limpiar selección
                selectedWords = [];
            }
        });
    });

    // Función para obtener la categoría de una palabra (función de ejemplo, reemplazar con su lógica)
    function getCategory(word) {
        const fruitWords = ["Manzana", "Plátano", "Sandía", "Uvas"];
        const greetingWords = ["Hola", "Hola", "Hey", "¿Qué tal?"];
        const colorWords = ["Rojo", "Azul", "Verde", "Amarillo"];
        const animalWords = ["Perro", "Gato", "Pájaro", "Elefante"];

        if (fruitWords.includes(word)) return 1;
        if (greetingWords.includes(word)) return 2;
        if (colorWords.includes(word)) return 3;
        if (animalWords.includes(word)) return 4;
        return 0;
    }

    // Función para generar un color aleatorio
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    // Función de mezcla
    function reshuffle() {
        const container = document.querySelector('.container');
        const words = container.querySelectorAll('.word');
        const shuffledWords = Array.from(words).sort(() => Math.random() - 0.5);
        shuffledWords.forEach(word => container.appendChild(word));
    }

    // Función de pistas
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

        // Mostrar una ventana con las categorías
        alert(hintsText);
    }

    // Función de cierre de sesión
    function logout() {
        window.location.href = 'logging.php'; // Redirigir a logging.php
    }
</script>

</body>
</html>
