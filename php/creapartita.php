<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea Partita</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input {
            width: calc(100% - 16px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            margin-top: 20px;
            color: #555;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
        .logout {
            position: absolute;
            top: 20px;
            right: 130px;
        }

        .logout a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-size: 16px;
            border: 1px solid #ffeead;
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #45a049;
        }

        .logout a:hover {
            background-color: #fff;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Crea Partita</h2>
        <form method="post" action="creapartitaV.php">
            <div class="form-group">
                <label for="categoria">avversario:</label>
                <input type="text" name="avversario" required>
            </div>
            <div class="form-group">
                <label for="categoria">risultato(0-0):</label>
                <input type="text" name="risultato" required>
            </div>
            <div class="form-group">
                <label for="categoria">DATA:</label>
                <input type="date" name="data" required>
            </div>
            <button type="submit">Crea partita</button>
            <div class="logout">
                <a href="home.php">torna indietro</a>
            </div>
        </form>
    </div>
</body>

</html>