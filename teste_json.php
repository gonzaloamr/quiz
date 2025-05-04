<?php
header('Content-Type: application/json');
echo json_encode([
    'status' => 'success',
    'message' => 'Teste de JSON funcionando',
    'data' => [
        'teste' => '123',
        'array' => [1, 2, 3]
    ]
]);
?> 