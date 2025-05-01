<?php
// Connessione al DB
$conn = new mysqli('db', 'root', 'root', 'test');
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Prendi ruolo e nome dalla query string
$ruolo = $_GET['ruolo'] ?? '';
$nomeUtente = $_GET['nome'] ?? '';

// Se admin → mostra tutti
if ($ruolo === 'admin') {
    $sql = "SELECT * FROM utenti";
} else {
    // Altrimenti mostra solo i dati dell'utente loggato
    $sql = "SELECT * FROM utenti WHERE nome = '$nomeUtente'";
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>zona login</title>
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
        }
    </style>
</head>
<body>
    <h1>Benvenuto nella zona segreta!</h1>
    <h2>
        <?php 
        echo $ruolo === 'admin' ? "Accesso Admin: tutti gli utenti" : "Accesso Utente: solo i tuoi dati"; 
        ?>
    </h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Ruolo</th>
            <th>Nome</th>
            <th>Password</th>
        </tr>
        <?php
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['ruolo']."</td>";
                echo "<td>".$row['nome']."</td>";
                echo "<td>".$row['pass']."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nessun dato disponibile</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
