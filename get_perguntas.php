<?php
// Habilitar exibição de erros para debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Garantir que não há saída antes do JSON
ob_start();

require_once 'config/database.php';

// Limpar qualquer saída anterior
ob_clean();

// Definir o cabeçalho JSON
header('Content-Type: application/json; charset=utf-8');

try {
    // Verificar conexão
    if (!$pdo) {
        throw new Exception('Conexão com o banco de dados não estabelecida');
    }

    // Testar a conexão
    $pdo->query("SELECT 1");
    
    // Verificar se a tabela existe
    $tabelaExiste = $pdo->query("SHOW TABLES LIKE 'perguntas'")->rowCount() > 0;
    if (!$tabelaExiste) {
        throw new Exception('Tabela perguntas não existe');
    }

    // Verificar se há perguntas
    $totalPerguntas = $pdo->query("SELECT COUNT(*) FROM perguntas")->fetchColumn();
    if ($totalPerguntas == 0) {
        throw new Exception('Não há perguntas cadastradas');
    }

    // Buscar perguntas aleatórias
    $stmt = $pdo->query("SELECT * FROM perguntas ORDER BY RAND() LIMIT 3");
    $perguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Converter caracteres especiais
    foreach ($perguntas as &$pergunta) {
        $pergunta['pergunta'] = mb_convert_encoding($pergunta['pergunta'], 'UTF-8', 'auto');
        $pergunta['opcao_a'] = mb_convert_encoding($pergunta['opcao_a'], 'UTF-8', 'auto');
        $pergunta['opcao_b'] = mb_convert_encoding($pergunta['opcao_b'], 'UTF-8', 'auto');
        $pergunta['opcao_c'] = mb_convert_encoding($pergunta['opcao_c'], 'UTF-8', 'auto');
        $pergunta['opcao_d'] = mb_convert_encoding($pergunta['opcao_d'], 'UTF-8', 'auto');
    }
    
    $response = [
        'status' => 'success',
        'data' => $perguntas,
        'debug' => [
            'total_perguntas' => $totalPerguntas,
            'perguntas_selecionadas' => count($perguntas),
            'conexao' => 'OK',
            'tabela_existe' => true
        ]
    ];
    
    echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    
} catch(PDOException $e) {
    http_response_code(500);
    $response = [
        'status' => 'error',
        'message' => 'Erro de banco de dados: ' . $e->getMessage(),
        'debug' => [
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'code' => $e->getCode()
        ]
    ];
    echo json_encode($response);
} catch(Exception $e) {
    http_response_code(500);
    $response = [
        'status' => 'error',
        'message' => $e->getMessage(),
        'debug' => [
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]
    ];
    echo json_encode($response);
}

// Garantir que não há saída após o JSON
exit();
?> 