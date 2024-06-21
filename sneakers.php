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
    <link rel="icon" href="images/Design sem nome (6).png">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type='text/javascript' src='js/jquery.touchSwipe.min.js'></script>
    <script src="js/slideshow.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Goblin+One&family=Sedan+SC&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="drip.css">
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
            <div class="text-box">
            <div class="text-box">
    <button type="submit" name="adicionar_ao_carrinho" class="btn btn-white btn-animate">Adicionar ao carrinho</button>
</div>
</div>
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
<?php
        include('footer.php');
    ?>
</body>
</html>
