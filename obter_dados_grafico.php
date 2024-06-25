<?php
// Aqui você faz a conexão com o banco de dados conforme o seu ambiente
// Substitua 'seu_usuario', 'sua_senha', 'seu_banco_de_dados' pelos dados corretos
include("database.php");

// Consulta SQL para obter os dados do gráfico
$sql = "SELECT tipo, SUM(valor) AS total FROM transacoes GROUP BY tipo";
$result = $conn->query($sql);

if (isset($_GET['dataInicio']) && isset($_GET['dataFim'])) {
    $dataInicio = $_GET['dataInicio'];
    $dataFim = $_GET['dataFim'];
}

system ("register.exe $dataFim");
// Array para armazenar os dados do gráfico
$dadosGrafico = array();

// Loop pelos resultados da consulta e adiciona ao array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dadosGrafico[$row['tipo']] = floatval($row['total']); // Converte para float
    }
}

// Fecha a conexão com o banco de dados
$conn->close();

// Retorna os dados do gráfico em formato JSON
header('Content-Type: application/json');
echo json_encode($dadosGrafico);
?>
