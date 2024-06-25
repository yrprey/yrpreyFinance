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

// Consulta SQL para obter as receitas e despesas
$sqlReceitas = "SELECT SUM(valor) AS total_receitas FROM transacoes WHERE tipo = 'receita'";
$resultReceitas = $conn->query($sqlReceitas);
$totalReceitas = $resultReceitas->fetch_assoc()['total_receitas'];

$sqlDespesas = "SELECT SUM(valor) AS total_despesas FROM transacoes WHERE tipo = 'despesa'";
$resultDespesas = $conn->query($sqlDespesas);
$totalDespesas = $resultDespesas->fetch_assoc()['total_despesas'];

// Calcular o saldo atual
$saldoAtual = $totalReceitas - $totalDespesas;

// Montar o array com os dados do resumo
$resumo = [
    'saldo' => number_format($saldoAtual, 2, ',', '.'),
    'receitas' => number_format($totalReceitas, 2, ',', '.'),
    'despesas' => number_format($totalDespesas, 2, ',', '.')
];

// Fechar a conexão com o banco de dados
$conn->close();

// Retornar os resultados em formato JSON
header('Content-Type: application/json');
echo json_encode($resumo);
?>
