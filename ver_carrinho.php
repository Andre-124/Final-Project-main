<?php
session_start();
include('ligacao.php');

// Função para remover do carrinho
function removerDoCarrinho($index) {
    if (isset($_SESSION['carrinho'][$index])) {
        unset($_SESSION['carrinho'][$index]);
        // Reindexar array para manter a sequência correta
        $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
    }
}

// Remover do carrinho se o link for clicado
if (isset($_GET['acao']) && $_GET['acao'] == 'remover' && isset($_GET['index'])) {
    removerDoCarrinho($_GET['index']);
}
?>

<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type='text/javascript' src='js/jquery.touchSwipe.min.js'></script>
    <link rel="icon" href="images/Design sem nome (6).png">
    <script src="js/slideshow.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Goblin+One&family=Sedan+SC&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="drip.css">
</head>
<body>

<?php include('cabecalho.php'); ?>

<div class="Container_Carrinho">
    <h1 style='padding: 20px; padding-bottom: 50px;'>O Seu Carrinho</h1>
    <?php
    if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
        $total = 0;
        foreach ($_SESSION['carrinho'] as $index => $item) {
            echo "<div class='cart-item'>";
            echo "<div class='cart-item-details'>";
            echo "<p class='cart-item-name'>{$item['nome']}</p>";
            echo "<p class='cart-item-size'>Tamanho: {$item['tamanho']}</p>";
            echo "<p class='cart-item-price'>Preço: {$item['preco']}€</p>";
            echo "</div>";
            echo "<div class='cart-item-action'>";
            echo "<a href='ver_carrinho.php?acao=remover&index={$index}' class='remove-button'>Remover</a>";
            echo "</div>";
            echo "</div>";
            $total += $item['preco'];
        }

        echo "<p style=\"font-size: 20px; font-weight: 900;\">Total: $total €</p>";
    ?>
        <div class="btnCarrinhos">
            <a href="Allsneakers.php" class="continue-shopping">Continuar a Comprar</a>
            <a href="checkout.php" class="continue-shopping">Finalizar compra</a>
        </div>
    <?php    
    } else {
        echo "<p>O seu carrinho está vazio</p>";
    }
    ?>
</div>
    <?php
        include('footer.php');
    ?>
</body>
</html>
