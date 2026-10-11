<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: area_adm.php');
    exit;
}
include '../conexao.php';

$pastaUpload = 'uploads/';
$erro = '';

// guarda a imagem na pasta e retorna o nome dela
function salvarCartaz($arquivo, $pasta)
{
    if (!isset($arquivo) || $arquivo['error'] !== UPLOAD_ERR_OK) {
        return null;
    }
    $ext = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
        return null;
    }
    if (!is_dir($pasta)) {
        mkdir($pasta, 0777, true);
    }
    $nome = uniqid('cartaz_') . '.' . $ext;
    move_uploaded_file($arquivo['tmp_name'], $pasta . $nome);
    return $nome;
}

// cadastrar
if (isset($_POST['cadastrar'])) {
    $cartaz = salvarCartaz($_FILES['cartaz'] ?? null, $pastaUpload);
    $stmt = $pdo->prepare(
        "INSERT INTO shows (nome, descricao, data_show, categoria, preco, estoque, cartaz)
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->execute([
        $_POST['nome'], $_POST['descricao'], $_POST['data_show'],
        $_POST['categoria'], $_POST['preco'], $_POST['estoque'], $cartaz
    ]);
    header('Location: painel_adm.php');
    exit;
}

// atualizar
if (isset($_POST['atualizar'])) {
    $id = (int) $_POST['id'];
    $novoCartaz = salvarCartaz($_FILES['cartaz'] ?? null, $pastaUpload);

    if ($novoCartaz) {
        // remove a imagem antiga
        $stmt = $pdo->prepare("SELECT cartaz FROM shows WHERE id = ?");
        $stmt->execute([$id]);
        $antigo = $stmt->fetchColumn();
        if ($antigo && file_exists($pastaUpload . $antigo)) {
            unlink($pastaUpload . $antigo);
        }
        $stmt = $pdo->prepare(
            "UPDATE shows SET nome=?, descricao=?, data_show=?, categoria=?, preco=?, estoque=?, cartaz=? WHERE id=?"
        );
        $stmt->execute([
            $_POST['nome'], $_POST['descricao'], $_POST['data_show'],
            $_POST['categoria'], $_POST['preco'], $_POST['estoque'], $novoCartaz, $id
        ]);
    } else {
        $stmt = $pdo->prepare(
            "UPDATE shows SET nome=?, descricao=?, data_show=?, categoria=?, preco=?, estoque=? WHERE id=?"
        );
        $stmt->execute([
            $_POST['nome'], $_POST['descricao'], $_POST['data_show'],
            $_POST['categoria'], $_POST['preco'], $_POST['estoque'], $id
        ]);
    }
    header('Location: painel_adm.php');
    exit;
}

// excluir
if (isset($_POST['excluir'])) {
    $id = (int) $_POST['id'];
    $stmt = $pdo->prepare("SELECT cartaz FROM shows WHERE id = ?");
    $stmt->execute([$id]);
    $cartaz = $stmt->fetchColumn();
    if ($cartaz && file_exists($pastaUpload . $cartaz)) {
        unlink($pastaUpload . $cartaz);
    }
    try {
        $stmt = $pdo->prepare("DELETE FROM shows WHERE id = ?");
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        // show com vendas não pode ser apagado
        $erro = 'Não foi possível excluir: este show possui vendas registradas.';
    }
    if (!$erro) {
        header('Location: painel_adm.php');
        exit;
    }
}

// busca um show para ver ou editar
$showVer = null;
$showEdicao = null;

if (isset($_GET['ver'])) {
    $stmt = $pdo->prepare("SELECT * FROM shows WHERE id = ?");
    $stmt->execute([(int) $_GET['ver']]);
    $showVer = $stmt->fetch(PDO::FETCH_ASSOC);
}
if (isset($_GET['editar'])) {
    $stmt = $pdo->prepare("SELECT * FROM shows WHERE id = ?");
    $stmt->execute([(int) $_GET['editar']]);
    $showEdicao = $stmt->fetch(PDO::FETCH_ASSOC);
}

// lista todos
$shows = $pdo->query("SELECT * FROM shows ORDER BY data_show DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Painel Admin - Palco</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Painel Administrativo - Shows</h1>
    <a href="logout.php" class="btn btn-outline-secondary btn-sm">Sair</a>
  </div>

  <?php if ($erro): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
  <?php endif; ?>

  <!-- detalhes -->
  <?php if ($showVer): ?>
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between">
        <strong><?= htmlspecialchars($showVer['nome']) ?></strong>
        <a href="painel_adm.php" class="btn-close"></a>
      </div>
      <div class="card-body row">
        <?php if ($showVer['cartaz']): ?>
          <div class="col-md-3">
            <img src="<?= $pastaUpload . htmlspecialchars($showVer['cartaz']) ?>" class="img-fluid rounded" alt="Cartaz">
          </div>
        <?php endif; ?>
        <div class="col">
          <p><?= nl2br(htmlspecialchars($showVer['descricao'])) ?></p>
          <p class="mb-1"><b>Data:</b> <?= date('d/m/Y', strtotime($showVer['data_show'])) ?></p>
          <p class="mb-1"><b>Categoria:</b> <?= htmlspecialchars($showVer['categoria']) ?></p>
          <p class="mb-1"><b>Preço:</b> R$ <?= number_format($showVer['preco'], 2, ',', '.') ?></p>
          <p class="mb-0"><b>Estoque:</b> <?= (int) $showVer['estoque'] ?></p>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <!-- formulário -->
  <div class="card mb-4">
    <div class="card-header">
      <?= $showEdicao ? 'Editar show' : 'Cadastrar novo show' ?>
    </div>
    <div class="card-body">
      <form method="post" enctype="multipart/form-data" class="row g-3">
        <?php if ($showEdicao): ?>
          <input type="hidden" name="id" value="<?= $showEdicao['id'] ?>">
        <?php endif; ?>

        <div class="col-md-6">
          <label class="form-label">Nome</label>
          <input type="text" name="nome" class="form-control" required
                 value="<?= $showEdicao ? htmlspecialchars($showEdicao['nome']) : '' ?>">
        </div>
        <div class="col-md-3">
          <label class="form-label">Data</label>
          <input type="date" name="data_show" class="form-control" required
                 value="<?= $showEdicao ? $showEdicao['data_show'] : '' ?>">
        </div>
        <div class="col-md-3">
          <label class="form-label">Categoria</label>
          <input type="text" name="categoria" class="form-control" required
                 value="<?= $showEdicao ? htmlspecialchars($showEdicao['categoria']) : '' ?>">
        </div>
        <div class="col-12">
          <label class="form-label">Descrição</label>
          <textarea name="descricao" class="form-control" rows="3"><?= $showEdicao ? htmlspecialchars($showEdicao['descricao']) : '' ?></textarea>
        </div>
        <div class="col-md-3">
          <label class="form-label">Preço (R$)</label>
          <input type="number" step="0.01" min="0" name="preco" class="form-control" required
                 value="<?= $showEdicao ? $showEdicao['preco'] : '' ?>">
        </div>
        <div class="col-md-3">
          <label class="form-label">Estoque</label>
          <input type="number" min="0" name="estoque" class="form-control" required
                 value="<?= $showEdicao ? $showEdicao['estoque'] : '' ?>">
        </div>
        <div class="col-md-6">
          <label class="form-label">Cartaz (jpg, png, webp)</label>
          <input type="file" name="cartaz" class="form-control" accept="image/*">
          <?php if ($showEdicao && $showEdicao['cartaz']): ?>
            <small class="text-muted">Deixe vazio para manter o cartaz atual.</small>
          <?php endif; ?>
        </div>

        <div class="col-12">
          <?php if ($showEdicao): ?>
            <button name="atualizar" class="btn btn-primary">Salvar alterações</button>
            <a href="painel_adm.php" class="btn btn-secondary">Cancelar</a>
          <?php else: ?>
            <button name="cadastrar" class="btn btn-success">Cadastrar</button>
          <?php endif; ?>
        </div>
      </form>
    </div>
  </div>

  <!-- tabela -->
  <div class="card">
    <div class="card-header">Shows cadastrados</div>
    <div class="table-responsive">
      <table class="table table-striped align-middle mb-0">
        <thead>
          <tr>
            <th>Cartaz</th>
            <th>Nome</th>
            <th>Data</th>
            <th>Categoria</th>
            <th>Preço</th>
            <th>Estoque</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!$shows): ?>
            <tr><td colspan="7" class="text-center text-muted">Nenhum show cadastrado.</td></tr>
          <?php endif; ?>
          <?php foreach ($shows as $s): ?>
            <tr>
              <td>
                <?php if ($s['cartaz']): ?>
                  <img src="<?= $pastaUpload . htmlspecialchars($s['cartaz']) ?>" width="50" class="rounded" alt="">
                <?php endif; ?>
              </td>
              <td><?= htmlspecialchars($s['nome']) ?></td>
              <td><?= date('d/m/Y', strtotime($s['data_show'])) ?></td>
              <td><?= htmlspecialchars($s['categoria']) ?></td>
              <td>R$ <?= number_format($s['preco'], 2, ',', '.') ?></td>
              <td><?= (int) $s['estoque'] ?></td>
              <td>
                <a href="painel_adm.php?ver=<?= $s['id'] ?>" class="btn btn-info btn-sm">Ver</a>
                <a href="painel_adm.php?editar=<?= $s['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                <form method="post" class="d-inline" onsubmit="return confirm('Excluir este show?')">
                  <input type="hidden" name="id" value="<?= $s['id'] ?>">
                  <button name="excluir" class="btn btn-danger btn-sm">Excluir</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>
</body>
</html>