<?php
//connetto al DB
$conn = new mysqli('db', 'root', 'root', 'test');
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

//recupero ruolo e nome utente da query string
$ruolo = $_GET['ruolo'] ?? '';
$nomeUtente = $_GET['nome'] ?? '';

if ($ruolo === 'admin') {
    //admin vede tutte le transazioni
    $sql = "SELECT t.id, u.nome, t.importo, t.carta, t.data_operazione
            FROM transazioni t
            JOIN utenti u ON t.id_utente = u.id";
} else {
    //recupero id dell'utente
    $stmt = $conn->prepare("SELECT id FROM utenti WHERE nome = ?");
    $stmt->bind_param("s", $nomeUtente);
    
    
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($idUtente);
        $stmt->fetch();

        $sql = "SELECT t.id, u.nome, t.importo, t.carta, t.data_operazione
                FROM transazioni t
                JOIN utenti u ON t.id_utente = u.id
                WHERE t.id_utente = $idUtente";
    } else {
        $sql = "SELECT * FROM transazioni WHERE 1=0"; //niente risultato
    }
    $stmt->close();



}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Transazioni</title>
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
            width: 80%;
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
    <h2>
        <?php 
        echo $ruolo === 'admin' ? "Accesso Admin: tutte le transazioni" : "Accesso Utente: solo le tue transazioni"; 
        ?>
    </h2>
    <table>
        <tr>
            <th>ID Transazione</th>
            <th>Utente</th>
            <th>Importo</th>
            <th>Numero Carta</th>
            <th>Data Operazione</th>
        </tr>
        <?php
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['nome']."</td>";
                echo "<td>€ ".$row['importo']."</td>";
                echo "<td>".$row['carta']."</td>";
                echo "<td>".$row['data_operazione']."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Nessuna transazione disponibile</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
