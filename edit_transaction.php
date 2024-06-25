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
$tipo = $_POST['tipo'];
$valor = $_POST['valor'];
$descricao = $_POST['descricao'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($id)) {
    $stmt = $conn->prepare("UPDATE transacoes SET tipo = ?, valor = ?, descricao = ? WHERE id = ?");
    $stmt->bind_param("sdsi", $tipo, $valor, $descricao, $id);

    if ($stmt->execute()) {
        echo "OK";
    } else {
        echo "ERROR";
    }

    $stmt->close();
}

$conn->close();
?>
