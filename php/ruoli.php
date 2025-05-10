<?php
//connetto al DB
$conn = new mysqli('db', 'root', 'root', 'test');
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

//prendo ruolo e nome dalla query string
$ruolo = $_GET['ruolo'] ?? '';
$nomeUtente = $_GET['nome'] ?? '';




if (isset($_POST['nome']) && isset($_POST['password'])) {
    $nome = $_POST['nome'];
    $pass = $_POST['password'];
}
    //query vulnerabile a sql injection
    $sql = "SELECT * FROM utenti WHERE nome = '$nome' AND pass = '$pass'";
    
    


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
        } input, button {
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
if ($conn -> multi_query($sql)){
    do {
        if ($res = $conn -> store_result()){
            if ($res->num_rows > 0) {
                
                while($row = $res->fetch_assoc()) {
                        $ruolo = $row['ruolo'];
                        echo "<tr>";
                        echo "<td>".$row['id']."</td>";
                        echo "<td>".$row['ruolo']."</td>";
                        echo "<td>".$row['nome']."</td>";
                        echo "<td>".$row['pass']."</td>";
                        echo "</tr>";
                }
            }
            $res -> free();
        }
    } while ($conn -> next_result());

    $errore = "Password errata!";
} else {
    $errore = "Errore nella query: " . $conn->error;
}
        $conn->close();
        ?>
    </table>
</body>

<br><br>
<form action="transazioni.php" method="get">
    <input type="hidden" name="ruolo" value="<?php echo htmlspecialchars($ruolo); ?>">
    <input type="hidden" name="nome" value="<?php echo htmlspecialchars($nome); ?>">
    <button type="submit">Visualizza Transazioni</button>
</form>


<?php if ($ruolo == 'admin') { ?>
    <form action="utenti.php" method="get">
        <input type="hidden" name="ruolo" value="<?php echo htmlspecialchars($ruolo); ?>">
        <input type="hidden" name="nome" value="<?php echo htmlspecialchars($nome); ?>">
        <button type="submit">Visualizza Utenti</button>
    </form>
<?php } ?>

</html>
