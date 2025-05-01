<?php
$conn = new mysqli('db', 'root', 'root', 'test'); // connessione a MySQL
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errore = "";

if (isset($_POST['nome']) && isset($_POST['password'])) {
    $nome = $_POST['nome'];
    $pass = $_POST['password'];

    // Query vulnerabile a SQL injection
    $sql = "SELECT * FROM utenti WHERE nome = '$nome' AND pass = '$pass'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ruolo = $row['ruolo'];
        $nomeUtente = $row['nome'];
        header("Location: segreto.php?ruolo=$ruolo&nome=$nomeUtente");
        exit();
    } else {
        $errore = "Password errata!";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>sql injection</title>
    <style>
        body {
            background-color: #0a0a23; 
            color: #f0f0f0;            
            font-family: 'Courier New', Courier, monospace; 
            text-align: center;
            margin-top: 100px;
        }
        input, button {
            padding: 10px;
            margin: 10px;
            background-color: #1e1e3f; 
            color: white;
            border: 1px solid #555;
            border-radius: 5px;
        }
        input:focus, button:hover {
            background-color: #333366; 
        }
    </style>
</head>
<body>
    <h1>sql injection</h1>
    <form method="post">
        nome: <input type="text" name="nome"/>
        password: <input type="text" name="password"/>
        <button type="submit">invia</button>
    </form>
    <?php
    if (!empty($errore)) {
        echo "<h2>$errore</h2>";
    }
    ?>
</body>
</html>
