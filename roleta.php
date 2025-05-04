<?php
require_once 'config/database.php';
session_start();

// Buscar prêmios do banco de dados
$stmt = $pdo->query("SELECT * FROM premios");
$premios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roleta de Prêmios</title>
    <link rel="stylesheet" href="css/roleta.css">
</head>
<body>
    <div class="container">
        <h1>Roleta de Prêmios</h1>
        <div class="roleta-container">
            <div class="roleta" id="roleta">
                <?php foreach ($premios as $premio): ?>
                    <div class="item-roleta"><?php echo htmlspecialchars($premio['nome']); ?></div>
                <?php endforeach; ?>
            </div>
            <div class="ponteiro"></div>
        </div>
        <button id="girar-roleta">Girar Roleta</button>
    </div>
    <script>
        const premios = <?php echo json_encode($premios); ?>;
    </script>
    <script src="js/roleta.js"></script>
</body>
</html> 