<?php
// Conexão com o banco de dados
include("database.php");

// Consulta SQL para obter os dados do gráfico
$sql = "SELECT SUM(valor) AS receitas FROM transacoes WHERE tipo = 'receita'";
$result = $conn->query($sql);
$receitas = $result->fetch_assoc()['receitas'];

$sql = "SELECT SUM(valor) AS despesas FROM transacoes WHERE tipo = 'despesa'";
$result = $conn->query($sql);
$despesas = $result->fetch_assoc()['despesas'];

// Montar array com os dados do gráfico
$dadosGrafico = [
    'receitas' => floatval($receitas), // Converter para float
    'despesas' => floatval($despesas) // Converter para float
];

// Fechar conexão com o banco de dados
$conn->close();

// Retornar os resultados em formato JSON
header('Content-Type: application/json');
echo json_encode($dadosGrafico);
?>
