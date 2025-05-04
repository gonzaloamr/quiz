<?php
require_once 'config/database.php';
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Interativo</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Quiz Interativo</h1>
        <div id="quiz-container">
            <div id="pergunta-container">
                <h2 id="pergunta-texto"></h2>
                <div id="opcoes-container"></div>
            </div>
            <div id="resultado-container" style="display: none;">
                <h2 id="resultado-texto"></h2>
                <button id="proxima-pergunta">Próxima Pergunta</button>
            </div>
        </div>
    </div>
    <script src="js/quiz.js"></script>
</body>
</html> 