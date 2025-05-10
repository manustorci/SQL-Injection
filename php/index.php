<?php
$conn = new mysqli('db', 'root', 'root', 'test'); //connetto a mysql
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errore = "";


    
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
    <form method="post"
        action="ruoli.php"
        >
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
