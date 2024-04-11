<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Registrazione</title>
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
    </style> 
</head>
<body>
    <div class="container">
        <h2>Registrazione</h2>
        <form method="post" action="registraV.php">
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
                <label for="DataNascita">Data di Nascita:</label>
                <input type="date" name="DataNascita" required>
            </div>
            <div class="form-group">
                <label for="email">email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="ruolo">ruolo:</label>
                <input type="ruolo" name="ruolo" required>
            </div>
            <div class="form-group">
                <label for="TenantID">TenantID:</label>
                <input type="TenantID" name="TenantID" required>
            </div>
            <button type="submit">Registrati</button>
        </form>
        <p>Se hai già un account, effettua il <a href="login.php">login</a>.</p>
    </div>
</body>
</html>