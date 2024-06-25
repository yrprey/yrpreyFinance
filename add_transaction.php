<?php

include("database.php");

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($data)) {
    $tipo = $data['tipoTransacao'];
    $valor = $data['valorTransacao'];
    $descricao = $data['descricaoTransacao'];
    $dataTransacao = date('Y-m-d'); // Data atual

    $stmt = $conn->prepare("INSERT INTO transacoes (data, tipo, valor, descricao) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $dataTransacao, $tipo, $valor, $descricao);

    if ($stmt->execute()) {
        echo "OK";
    } else {
        echo json_encode(["success" => false, "error" => $conn->error]);
    }

    $stmt->close();
}

$conn->close();
?>
