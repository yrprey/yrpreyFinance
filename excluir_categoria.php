<?php

include("database.php");

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM categorias WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Categoria excluída com sucesso!";
    } else {
        echo "Erro ao excluir categoria: " . $conn->error;
    }

    $stmt->close();
}

$$conn->close();
?>
