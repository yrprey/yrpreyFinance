<?php
// Conexão com o banco de dados utilizando MySQLi
$mysqli = new mysqli('localhost', 'root', '', 'yrpreyfinance');

// Verificar a conexão
if ($mysqli->connect_errno) {
    die("Falha na conexão com o banco de dados: " . $mysqli->connect_error);
}

// Termo de pesquisa enviado via GET
$termo = $_GET['termo'];

// Preparar a consulta
$stmt = $mysqli->prepare('SELECT * FROM categorias WHERE nome LIKE ?');
if (!$stmt) {
    die("Erro na preparação da consulta: " . $mysqli->error);
}

// Adicionar o caractere % ao termo de pesquisa
$termo_pesquisa = '%' . $termo . '%';

// Vincular o parâmetro à consulta
$stmt->bind_param('s', $termo_pesquisa);

// Executar a consulta
if (!$stmt->execute()) {
    die("Erro ao executar a consulta: " . $stmt->error);
}

// Obter resultados
$resultados = $stmt->get_result();

// Criar um array para armazenar os resultados
$resultados_array = [];

// Loop pelos resultados e adicionar ao array
while ($row = $resultados->fetch_assoc()) {
    $resultados_array[] = $row;
}

// Retornar resultados como JSON
header('Content-Type: application/json');
echo json_encode($resultados_array);

// Fechar a conexão e liberar recursos
$stmt->close();
$mysqli->close();
?>
