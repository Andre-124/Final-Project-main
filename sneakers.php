<?php
session_start();
include('ligacao.php');

// Função para adicionar ao carrinho
function adicionarAoCarrinho($produto) {
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }
    $_SESSION['carrinho'][] = $produto;
}

// Adicionar ao carrinho se o formulário for submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['adicionar_ao_carrinho'])) {
    $produto = [
        'codigo' => $_POST['codigo_produto'],
        'nome' => $_POST['nome_produto'],
        'preco' => $_POST['preco_produto'],
        'tamanho' => $_POST['tamanho_produto']
    ];
    adicionarAoCarrinho($produto);
}

// Obter o produto da base de dados
if (isset($_GET['cod'])) {
    $consulta = "SELECT * FROM produtos WHERE Codproduto=" . $_GET['cod'];
    $resProdutos = $ligacao->query($consulta);
    $produto = $resProdutos->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raining Drip</title>
    <link rel="stylesheet" href="drip.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="icon" href="images/Design sem nome (6).png">
</head>
<body>

<?php include('cabecalho.php'); ?>

<?php if (isset($produto)): ?>
<div class="container">
    <div class="product-image">
        <div id="product_viewer"></div>
    </div>
    <div class="product-details">
        <h4><?= $produto['Nome'] ?></h4>
        <form id="compraForm" action="sneakers.php?cod=<?= $produto['Codproduto'] ?>" method="post">
            <input type="hidden" name="codigo_produto" value="<?= $produto['Codproduto'] ?>">
            <input type="hidden" name="nome_produto" value="<?= $produto['Nome'] ?>">
            <input type="hidden" name="preco_produto" value="<?= $produto['Preco'] ?>">
            <label for="tamanho">Escolha o tamanho:</label>
            <select id="tamanho" name="tamanho_produto">
                <option value="35">35</option>
                <option value="36">36</option>
                <option value="37">37</option>
                <option value="38">38</option>
                <option value="39">39</option>
                <option value="40">40</option>
                <option value="41">41</option>
                <option value="42">42</option>
                <option value="43">43</option>
                <option value="44">44</option>
            </select>
            <br>
            <div>Preço: <?= $produto['Preco'] ?>€</div>
            <button class="nike-button" type="submit" name="adicionar_ao_carrinho">Adicionar ao Carrinho</button>
        </form>
    </div>
</div>

<script src="js/product-viewer.js"></script>
<script>
  var productViewer = new ProductViewer({
    element: document.getElementById('product_viewer'),
    imagePath: 'images/<?= $produto['imagens'] ?>',
    filePrefix: 'img',
    fileExtension: '.avif'
  });

  ProductViewer.once('loaded', function (){
    ProductViewer.animate360();
  });
</script>

<?php endif; ?>

</body>
</html>
