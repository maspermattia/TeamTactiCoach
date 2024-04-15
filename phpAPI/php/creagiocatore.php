<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea Giocatore</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        .page-container {
            max-width: 1200px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        h2 {
            color: #333;
        }

        .form-container,
        .player-list {
            margin-bottom: 30px;
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
            box-sizing: border-box;
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

        .logout {
    position: absolute;
    top: 10px;
    right: 10px;
    text-align: right;
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
    display: inline-block;
}
        .logout a:hover {
            background-color: #fff;
            color: #333;
        }

        .player-list,
        .form-container {
            width: 50%;

            
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }

        .logout-container {
            width: 100%;
            display: flex;
            justify-content: flex-start;
            margin-bottom: 20px;
        }

        .logout-container a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-size: 16px;
            border: 1px solid #ffeead;
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #45a049;
            display: inline-block;
        }

        .logout-container a:hover {
            background-color: #fff;
            color: #333;
        }
        .player-list,
    .form-container {
        width: 50%;
    }

    
    .form-container {
        float: right;
    }

    .player-list {
        float: left;
    }

    @media (max-width: 768px) {
        
        .form-container,
        .player-list {
            width: 100%;
            float: none;
        }
    }

    </style>
   
</head>

<body>
    <div class="page-container">
        <div class="container">
            <div class="player-list">
                <h2>Lista Giocatori</h2>
                <?php
                session_start();
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "TeamTactiCoach";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connessione al database fallita: " . $conn->connect_error);
                }

                $SquadraID = $_SESSION['squadraID'];

                $sql = "SELECT GiocatoriID, Nickname
                        FROM Giocatore WHERE SquadraID = '$SquadraID'";

                $result = $conn->query($sql);

                echo "<table>
                        <tr>
                            <th>ID Giocatore</th>
                            <th>Nickname</th>
                        </tr>";

                $counter = 1;

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $counter++ . "</td>
                            <td>" . $row["Nickname"] . "</td>
                          </tr>";
                }

                echo "</table>";

                $conn->close();
                ?>
            </div>
            <div class="form-container">
                <h2>Crea Giocatore</h2>
                <form method="post" action="creagiocatoreV.php">
                    <div class="form-group">
                        <label for="nickname">Nickname del giocatore:</label>
                        <input type="text" id="nickname" name="Nickname" required>
                    </div>
                    <button type="submit">Aggiungi Giocatore</button>
                </form>
            </div>
        </div>
        <div class="logout">
            <a href="home.php">Torna indietro</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            
            $("form").submit(function (event) {
                
                event.preventDefault();

                
                var formData = $(this).serialize();

               
                $.ajax({
                    type: "POST",
                    url: "creagiocatoreV.php", 
                    data: formData,
                    success: function (response) {
                     
                        $(".player-list table tbody").append(response);

                        $("form")[0].reset();
                    }
                });
            });
        });
    </script>
</body>

</html>
