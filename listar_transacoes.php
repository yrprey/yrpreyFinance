<?php

include("database.php");

$query = isset($_GET['query']) ? $_GET['query'] : '';
$sql = "SELECT id, data, tipo, valor, descricao FROM transacoes WHERE descricao LIKE ?";
$stmt = $conn->prepare($sql);
$searchTerm = '%' . $query . '%';
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<th scope='row'>" . $row['id']."</th>";
        echo "<td>" . $row['data']."</td>";
        echo "<td>" . $row['tipo']."</td>";
        echo "<td>R$ " . $row['valor']."</td>";
        echo "<td>" . $row['descricao']."</td>";
        echo "<td>";
        echo "<button class='btn btn-warning btn-sm edit-btn' data-id='" . $row['id'] . "' data-tipo='" . $row['tipo']."' data-valor='" . $row['valor']."' data-descricao='" . $row['descricao']."'>Editar</button> ";
        echo "<button class='btn btn-danger btn-sm delete-btn' data-id='" . $row['id'] . "'>Excluir</button>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>Nenhuma transação encontrada</td></tr>";
}

$stmt->close();
$$conn->close();
?>
