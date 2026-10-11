<?php
require_once 'conexao.php';

$resultado = $conexao->query("SELECT * FROM shows ORDER BY data_show");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Shows</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>

<body>

    <h2> Shows Cadastrados</h2>

    <?php if ($resultado->num_rows === 0): ?>
        <p>Nenhum show cadastrado.</p>
    <?php endif; ?>

    <?php while ($show = $resultado->fetch_assoc()): ?>

        <?php if (!empty($show['imagem'])): ?>
            <img src="uploads/<?= htmlspecialchars($show['imagem']) ?>" alt="<?= htmlspecialchars($show['titulo']) ?>" width="200">
        <?php endif; ?>

        <h3><?= htmlspecialchars($show['titulo']) ?></h3>
        <p><?= htmlspecialchars($show['descricao']) ?></p>
        <p>Data: <?= date('d/m/Y', strtotime($show['data_show'])) ?></p>
        <p>Local: <?= htmlspecialchars($show['locals']) ?></p>
        <p>Preço: R$ <?= number_format($show['preco'], 2, ',', '.') ?></p>
        <p>Capacidade: <?= $show['capacidade'] ?></p>
        <p>Ingressos disponíveis: <?= $show['ing_disponiveis'] ?></p>

        <hr>



    <?php endwhile; ?>



    <?php include '../sidebar/sidebar.php'; ?>

    <main class="flex-1 p-6">
        <h2>Conteúdo da página aqui</h2>
    </main>


</body>
</html>
