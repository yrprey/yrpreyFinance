<?php

include("database.php");

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];

    $stmt = $conn->prepare("UPDATE categorias SET nome = ? WHERE id = ?");
    $stmt->bind_param("si", $nome, $id);

    if ($stmt->execute()) {
        echo "Categoria editada com sucesso!";
    } else {
        echo "Erro ao editar categoria: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
