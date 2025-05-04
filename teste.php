<?php
require_once 'config/database.php';

try {
    // Testar conexão
    echo "Conexão com o banco de dados estabelecida com sucesso!<br><br>";
    
    // Verificar tabelas
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo "Tabelas encontradas:<br>";
    foreach ($tables as $table) {
        echo "- $table<br>";
    }
    
    // Verificar perguntas
    $stmt = $pdo->query("SELECT COUNT(*) FROM perguntas");
    $count = $stmt->fetchColumn();
    echo "<br>Número de perguntas: $count<br>";
    
    // Mostrar perguntas
    $stmt = $pdo->query("SELECT * FROM perguntas");
    $perguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<br>Perguntas:<br>";
    foreach ($perguntas as $pergunta) {
        echo "- " . $pergunta['pergunta'] . "<br>";
    }
    
} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?> 