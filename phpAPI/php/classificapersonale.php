<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classifica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            border: 1px solid #ddd;
            background-color: #fff;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .dropdown {
            text-align: center;
            margin: 20px;
        }
    </style>
</head>
<body>

<h1>Classifiche</h1>

<div class="dropdown">
    <label for="classifica">Seleziona classifica:</label>
    <select id="classifica" onchange="showTable()">
        <option value="gol">Classifica Gol</option>
        <option value="assist">Classifica Assist</option>
    </select>
</div>

<div id="classificaGol">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "TeamTactiCoach";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connessione al database fallita: " . $conn->connect_error);
    }

    $allenatore_username = "Username1"; 

    $query = "SELECT G.Nickname, SUM(S.Gol) AS TotaleGol
              FROM Giocatore G
              JOIN Statistiche S ON G.GiocatoriID = S.GiocatoreID
              JOIN Squadra SQ ON G.SquadraID = SQ.SquadraID
              
              WHERE SQ.Username = '$allenatore_username'
              GROUP BY G.Nickname
              ORDER BY TotaleGol DESC";

    $result = $conn->query($query);

    echo "<table>";
    echo "<tr><th>Giocatore</th><th>Totale Gol</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["Nickname"] . "</td><td>" . $row["TotaleGol"] . "</td></tr>";
    }

    echo "</table>";

    $conn->close();
    ?>
</div>

<div id="classificaAssist" style="display:none;">
    <?php
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connessione al database fallita: " . $conn->connect_error);
    }

    $queryAssist = "SELECT G.Nickname, SUM(S.Assist) AS TotaleAssist
                    FROM Giocatore G
                    JOIN Statistiche S ON G.GiocatoriID = S.GiocatoreID
                    JOIN Squadra SQ ON G.SquadraID = SQ.SquadraID
                   
                    WHERE SQ.Username = '$allenatore_username'
                    GROUP BY G.Nickname
                    ORDER BY TotaleAssist DESC";

    $resultAssist = $conn->query($queryAssist);

    echo "<table>";
    echo "<tr><th>Giocatore</th><th>Totale Assist</th></tr>";

    while ($rowAssist = $resultAssist->fetch_assoc()) {
        echo "<tr><td>" . $rowAssist["Nickname"] . "</td><td>" . $rowAssist["TotaleAssist"] . "</td></tr>";
    }

    echo "</table>";

    $conn->close();
    ?>
</div>

<script>
    function showTable() {
        var selectedValue = document.getElementById("classifica").value;
        if (selectedValue === "gol") {
            document.getElementById("classificaGol").style.display = "block";
            document.getElementById("classificaAssist").style.display = "none";
        } else {
            document.getElementById("classificaGol").style.display = "none";
            document.getElementById("classificaAssist").style.display = "block";
        }
    }
</script>

<a href="home.php"><button>Torna a home</button></a>
</body>
</html>
