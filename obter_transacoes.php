<?php
// Aqui você faz a conexão com o banco de dados conforme o seu ambiente
// Substitua 'seu_usuario', 'sua_senha', 'seu_banco_de_dados' pelos dados corretos
include("database.php");

// Consulta SQL para obter as transações
$sql = "SELECT * FROM transacoes";
$result = $conn->query($sql);

// Array para armazenar as transações
$transacoes = array();

// Loop pelos resultados da consulta e adiciona ao array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $transacoes[] = array(
            'data' => $row['data'],
            'descricao' => $row['descricao'],
            'categoria' => $row['tipo'],
            'valor' => floatval($row['valor']), // Converte para float
        );
    }
}

// Fecha a conexão com o banco de dados
$conn->close();

// Retorna as transações em formato JSON
header('Content-Type: application/json');
echo json_encode($transacoes);
?>
