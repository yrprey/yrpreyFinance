<?php

include("database.php");

$query = isset($_GET['query']) ? $_GET['query'] : '';
$sql = "SELECT id, nome FROM categorias WHERE nome LIKE ? ORDER BY id DESC";
$stmt = $conn->prepare($sql);
$searchTerm = '%' . $query . '%';
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
        echo htmlspecialchars($row['nome']);
        echo "<div>";
        echo "<button class='btn btn-warning btn-sm edit-btn' data-id='" . $row['id'] . "' data-nome='" . htmlspecialchars($row['nome']) . "'>Editar</button> ";
        echo "<button class='btn btn-danger btn-sm delete-btn' data-id='" . $row['id'] . "'>Excluir</button>";
        echo "</div>";
        echo "</li>";
    }
} else {
    echo "<li class='list-group-item'>Nenhuma categoria encontrada</li>";
}

$stmt->close();
$conn->close();
?>
