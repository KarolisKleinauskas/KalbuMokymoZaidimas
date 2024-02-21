<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
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

        .registration-form {
            max-width: 300px;
            width: 100%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .registration-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .registration-form input[type="text"],
        .registration-form input[type="password"],
        .registration-form button {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .registration-form button {
            background-color: #8c05f4;
            color: #fff;
            cursor: pointer;
        }

        .registration-form button:hover {
            background-color: #8c05f4;
        }

        .spykeris {
            color: purple;
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
        <form class="registration-form" id="registrationForm" method="post" action="connection.php">
            <h2>Registracija</h2>
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
            <input
                    type="password"
                    id="confirmPassword"
                    name="confirmPassword"
                    placeholder="Patvirtinti slaptažodį"
                    required
            />
            <button type="submit">Registruotis</button>
            <div style="text-align: center">
                <a href="login.php">Jei turite paskyrą- prisijunkite čia</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
