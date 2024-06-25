<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yrpreyfinance";

$conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se a conexão foi estabelecida corretamente
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

$id = $_POST['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($id)) {
    $stmt = $conn->prepare("DELETE FROM transacoes WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "OK";
    } else {
        echo "ERROR";
    }

    $stmt->close();
}

$conn->close();
?>
