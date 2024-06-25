<?php
// Conexão com o banco de dados (substitua pelas suas informações)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yrpreyfinance";

$conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se a conexão foi estabelecida corretamente
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

// Consulta SQL para obter as últimas transações (por exemplo, as 5 últimas)
$sqlTransacoes = "SELECT * FROM transacoes ORDER BY data DESC LIMIT 5";
$resultTransacoes = $conn->query($sqlTransacoes);

// Array para armazenar as transações
$transacoes = [];

// Verificar se houve resultados
if ($resultTransacoes->num_rows > 0) {
    // Loop através dos resultados da consulta
    while ($row = $resultTransacoes->fetch_assoc()) {
        // Adicionar cada transação ao array
        $transacao = [
            'id' => $row['id'],
            'descricao' => $row['descricao'],
            'valor' => number_format($row['valor'], 2, ',', '.'),
            'data' => date('d/m/Y', strtotime($row['data'])) // Formatando a data
        ];
        $transacoes[] = $transacao;
    }
}

// Fechar a conexão com o banco de dados
$conn->close();

// Retornar os resultados em formato JSON
header('Content-Type: application/json');
echo json_encode($transacoes);
?>
