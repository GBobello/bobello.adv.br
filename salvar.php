<?php
header("Content-Type: application/json");

// Incluir a configuração do banco de dados
require_once "config.php";

// Capturar dados do formulário
$nome = trim($_POST["name"]) ?? "";
$email = trim($_POST["email"]) ?? "";
$telefone =  preg_replace("/[\s\-\(\)]/", "", $_POST["phone"]) ?? "";

// Verificar se os campos estão preenchidos
if (empty($nome) || empty($email) || empty($telefone)) {
    echo json_encode(["mensagem" => "Preencha todos os campos!"]);
    exit();
}

try {
    // Preparar a query SQL para evitar SQL Injection
    $stmt = $pdo->prepare("INSERT INTO leads (nome, email, telefone) VALUES (:nome, :email, :telefone)");
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":telefone", $telefone);

    // Executar a inserção
    if ($stmt->execute()) {
        echo json_encode(["mensagem" => "Cadastro realizado com sucesso!"]);
    } else {
        echo json_encode(["mensagem" => "Erro ao cadastrar"]);
    }
} catch (PDOException $e) {
    echo json_encode(["mensagem" => "Erro no banco de dados: " . $e->getMessage()]);
}
?>
