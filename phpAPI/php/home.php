<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TeamTactiCoach";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
if (!isset($_SESSION['username'])) {
    
    header("Location: login.php");
    exit();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-size: 16px;
        }

        .logout {
            position: absolute;
            top: 20px;
            right: 200px;
        }

        .logout a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-size: 16px;
            border: 1px solid #fff;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .logout a:hover {
            background-color: #fff;
            color: #333;
        }
        
    </style>
   
</script>

 

</head>
<body>

    <div class="container">
        <header>
            <h1>Benvenuto nella tua Home</h1>
            <nav>
                <ul>
                    <li><a href="creagiocatore.php">Crea Giocatore</a></li>
                    <li><a href="creapartita.php">Crea Partita</a></li>
                    <li><a href="creaallenamento.php">Crea Allenamento</a></li>
                    <li><a href="statistiche.php">agggiungi statistiche</a></li>
                    <li><a href="presenze.php">presenze</a></li>
                    <li><a href="classificapersonale.php">classifica</a></li>
                </ul>
            </nav>
            <div class="logout">
                <a href="logout.php">Logout</a>
            </div>
        </header>
    </div>

</body>
</html>
