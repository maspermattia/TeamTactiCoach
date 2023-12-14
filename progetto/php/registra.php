<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Registrazione</title>
</head>
<body>
    <div class="container">
        <h2>Registrazione</h2>
        <form method="post" action="RegistraV.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" required>
            </div>
            <div class="form-group">
                <label for="cognome">Cognome:</label>
                <input type="text" name="cognome" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="dataDiNascita">Data di Nascita:</label>
                <input type="date" name="dataDiNascita" required>
            </div>
            <div class="form-group">
                <label for="mail">Mail:</label>
                <input type="email" name="mail" required>
            </div>
            <div class="form-group">
                <label for="ruolo">ruolo:</label>
                <input type="ruolo" name="ruolo" required>
            </div>
            <button type="submit">Registrati</button>
        </form>
        <p>Se hai già un account, effettua il <a href="login.php">login</a>.</p>
    </div>
</body>
</html>