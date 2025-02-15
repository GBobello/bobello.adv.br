<?php
// Função para carregar variáveis do .env
function loadEnv($path)
{
    if (!file_exists($path)) {
        throw new Exception(".env file not found!");
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), "#") === 0) continue; // Ignorar comentários
        list($key, $value) = explode("=", $line, 2);
        $_ENV[trim($key)] = trim($value);
    }
}

try {
    // Carregar variáveis do .env
    loadEnv(__DIR__ . "/.env");

    // Criar conexão com MySQL usando PDO
    $pdo = new PDO(
        "mysql:host=" . $_ENV["DB_HOST"] . ";dbname=" . $_ENV["DB_NAME"] . ";charset=utf8",
        $_ENV["DB_USER"],
        $_ENV["DB_PASS"]
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
?>
