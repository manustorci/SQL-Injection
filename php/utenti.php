<?php
// Connessione al database
$conn = new mysqli('db', 'root', 'root', 'test');
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
$ruolo = $_GET['ruolo'] ?? '';
$nomeUtente = $_GET['nome'] ?? '';
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Visualizza Utenti</title>
    <style>
        body {
            background-color: #0a0a23;
            color: #f0f0f0;
            font-family: 'Courier New', Courier, monospace;
            text-align: center;
            margin-top: 50px;
        }
        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 70%;
        }
        th, td {
            border: 1px solid #f0f0f0;
            padding: 10px;
        }
        th {
            background-color: #1e1e3f;
        }input, button {
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

<h2>Visualizzazione Utenti</h2>

<?php

$sql = "SELECT * FROM utenti";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Ruolo</th><th>Nome</th><th>Password</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['ruolo']."</td>";
        echo "<td>".$row['nome']."</td>";
        echo "<td>".$row['pass']."</td>";
        echo "</tr>";
    }

    echo "</table>";
} 

$conn->close();
?>

<br><br>
<form action="ruoli.php" method="get">
    <input type="hidden" name="ruolo" value="<?php echo htmlspecialchars($ruolo); ?>">
    <input type="hidden" name="nome" value="<?php echo htmlspecialchars($nomeUtente); ?>">
    <button type="submit">Torna Indietro</button>
</form>
</body>
</html>
