<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yrpreyfinance";

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['categoria'])) {
    $nomeCategoria = $_POST['categoria'];

    // Cria a conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se a conexão foi estabelecida corretamente
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Prepara e executa a query para inserir a nova categoria
    $sql = "INSERT INTO categorias (nome) VALUES ('$nomeCategoria')";
    if ($conn->query($sql) === TRUE) {
        $response = array('success' => true);
    } else {
        $response = array('success' => false);
    }

    // Fecha a conexão com o banco de dados
    $conn->close();

    // Retorna a resposta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Se o formulário não foi submetido corretamente, retorna erro
    $response = array('success' => false);
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
