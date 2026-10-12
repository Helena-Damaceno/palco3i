<html>

<head>
    <meta charset="UTF-8">
    <title>Cadastrando Shows</title>
</head>

<body>

    <a href="painel_adm.php">Voltar</a>

    <h1>Formulário para Cadastrar Shows</h1>

    <form action="exec_create.php" method="POST" enctype="multipart/form-data"> 
    Nome do Show:
    <input type="text" name="titulo" size="50" required>
    <br><br>

    Descrição:
    <input type="text" name="descricao" size="50">
    <br><br>

    Data:
    <input type="date" name="data_show" required>
    <br><br>

    Local:
    <input type="text" name="locals" size="50" required>
    <br><br>

    Preço:
    <input type="number" name="preco" step="0.01" min="0" required>
    <br><br>

    Capacidade:
    <input type="number" name="capacidade" min="1" required>
    <br><br>

    Ingressos disponíveis:
    <input type="number" name="ing_disponiveis" min="0" required>
    <br><br>

    Categoria:
    <select name="id_categ" required>
        <option value="">Selecione uma categoria</option>
        <option value="1">Rock</option>
        <option value="2">MPB</option>
        <option value="3">Pop</option>
        <option value="4">Samba</option>
    </select>

    <br><br>

    Imagem:
    <input type="file" name="imagem" accept="image/*">

    <br><br>

    <input type="submit" value="Cadastrar">

    </form>