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
    $codProduto = $_GET['cod'];
    $consulta = "SELECT * FROM produtos WHERE Codproduto=" . $codProduto;
    $resProdutos = $ligacao->query($consulta);
    $produto = $resProdutos->fetch_assoc();
}

// Conexão
if (!$ligacao) {
    die("Connection failed: " . $ligacao->connect_error);
}

// Buscar produtos à base de dados
$sql = "SELECT Codproduto, Nome, Preco, Modelo, imagens, ImagemRef FROM produtos";
$result = $ligacao->query($sql);

if ($result === FALSE) {
    die("Error: " . $sql . "<br>" . $ligacao->error);
}

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Buscar produtos relacionados
$relatedProductsQuery = "SELECT Codproduto, Nome, Preco, ImagemRef FROM produtos WHERE Codproduto != $codProduto LIMIT 3";
$relatedProductsResult = $ligacao->query($relatedProductsQuery);

$relatedProducts = [];
if ($relatedProductsResult->num_rows > 0) {
    while ($row = $relatedProductsResult->fetch_assoc()) {
        $relatedProducts[] = $row;
    }
}

// Fechar conexão
$ligacao->close();
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
    <!-- Include the ProductViewer CSS file -->
    <link rel="stylesheet" href="css/product-viewer.css">
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
                <button type="submit" name="adicionar_ao_carrinho" class="btn btn-white btn-animate">Adicionar ao carrinho</button>
            </div>
        </form>
    </div>
</div>
<!-- Include the ProductViewer JS file -->
<script src="js/product-viewer.js"></script>
<script>
  var productViewer = new ProductViewer({
    element: document.getElementById('product_viewer'),
    imagePath: 'images/<?= $produto['imagens'] ?>', 
    filePrefix: 'img',
    fileExtension: '.avif',
    numImages: 36
  });

  productViewer.init();
</script>   

<!-- You May Also Like Section -->
<section id="sneakers">
    <h1>Poderá gostar</h1>
    <div id="cards">
        <?php foreach ($relatedProducts as $relatedProduct): ?>
            <div class="card_sneakers">
                <a href="sneakers.php?cod=<?= $relatedProduct['Codproduto'] ?>">
                    <img src="images/<?= $relatedProduct['ImagemRef'] ?>" alt="<?= $relatedProduct['Nome'] ?>">
                    <div class="card_container">
                        <h4><?= $relatedProduct['Nome'] ?></h4>
                        <h5><?= $relatedProduct['Preco'] ?>€</h5>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>
<?php include('footer.php'); ?>
</body>
</html>
