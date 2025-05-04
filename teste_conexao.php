<?php
require_once 'config/database.php';

try {
    echo "Tentando conectar ao banco de dados...<br>";
    
    // Testar conexão
    $pdo->query("SELECT 1");
    echo "Conexão estabelecida com sucesso!<br><br>";
    
    // Verificar tabelas
    echo "Tabelas disponíveis:<br>";
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    foreach ($tables as $table) {
        echo "- $table<br>";
    }
    
    // Verificar se a tabela perguntas existe
    echo "<br>Verificando tabela 'perguntas':<br>";
    $tabelaExiste = $pdo->query("SHOW TABLES LIKE 'perguntas'")->rowCount() > 0;
    if ($tabelaExiste) {
        echo "Tabela 'perguntas' existe!<br>";
        
        // Verificar estrutura da tabela
        echo "<br>Estrutura da tabela 'perguntas':<br>";
        $columns = $pdo->query("DESCRIBE perguntas")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($columns as $column) {
            echo "- {$column['Field']} ({$column['Type']})<br>";
        }
        
        // Verificar registros
        echo "<br>Registros na tabela 'perguntas':<br>";
        $count = $pdo->query("SELECT COUNT(*) FROM perguntas")->fetchColumn();
        echo "Total de registros: $count<br>";
        
        if ($count > 0) {
            echo "<br>Primeiros registros:<br>";
            $registros = $pdo->query("SELECT * FROM perguntas LIMIT 3")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($registros as $registro) {
                echo "<pre>";
                print_r($registro);
                echo "</pre>";
            }
        }
    } else {
        echo "Tabela 'perguntas' não existe!";
    }
    
} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?> 