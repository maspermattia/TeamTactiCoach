<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Allenamenti</title>
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
    </style>

   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<h1>Elenco Allenamenti</h1>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TeamTactiCoach";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

$sql = "SELECT * FROM Allenamento";
$result = $conn->query($sql);


    echo "<table border='1'>
            <tr>
                <th>ID Allenamento</th>
                <th>Data</th>
                <th>SquadraID</th>
                <th>Azione</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr id='row".$row["AllenamentoID"]."'>
                <td>" . $row["AllenamentoID"] . "</td>
                <td>" . $row["Data"] . "</td>
                <td>" . $row["SquadraID"] . "</td>
                <td><button class='delete' data-id='".$row["AllenamentoID"]."'>Elimina</button></td>
              </tr>";
    }

    echo "</table>";


$conn->close();
?>

<script>
$(document).ready(function(){
    $('.delete').click(function(){
        var el = this;
        var id = this.dataset.id;

        $.ajax({
            url: 'deleteallenamento.php',
            type: 'POST',
            data: { id: id },
            success: function(response){
               
                    $(el).closest('tr').css('background','tomato');
                    $(el).closest('tr').fadeOut(800,function(){
                       $(this).remove();
                    });
                
            }
        });
    });
});
</script>

<a href="homeadmin.php"><button>Torna a home</button></a>

</body>
</html>
    